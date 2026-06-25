<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Role;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Profesor;
use App\Models\Representante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('view-personas');
        $personas = Persona::with('user')->paginate(15);
        return view('admin.personas.index', compact('personas'));
    }

    public function create()
    {
        $this->authorize('create-persona');
        $roles = Role::all();
        return view('admin.personas.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('create-persona');
        $request->validate([
            'cedula_identidad'     => 'required|integer|unique:tabla_persona,cedula_identidad',
            'nombres'              => 'required|string|max:255',
            'apellidos'            => 'required|string|max:255',
            'correo'               => 'required|email|unique:tabla_persona,correo|unique:users,email',
            'telefono'             => 'required|string|max:20',
            'direccion_habitacion' => 'required|string|max:500',
            'rol'                  => 'required|exists:roles,slug',
        ], [
            'cedula_identidad.required'     => 'La cédula de identidad es obligatoria.',
            'cedula_identidad.integer'      => 'La cédula debe ser un número válido.',
            'cedula_identidad.unique'       => 'Ya existe una persona registrada con esa cédula.',
            'nombres.required'              => 'El nombre es obligatorio.',
            'apellidos.required'            => 'Los apellidos son obligatorios.',
            'correo.required'               => 'El correo electrónico es obligatorio.',
            'correo.email'                  => 'Ingrese un correo electrónico válido.',
            'correo.unique'                 => 'Ese correo ya está registrado en el sistema.',
            'telefono.required'             => 'El teléfono es obligatorio.',
            'direccion_habitacion.required' => 'La dirección de habitación es obligatoria.',
            'rol.required'                  => 'Debe seleccionar un rol.',
            'rol.exists'                    => 'El rol seleccionado no es válido.',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Crear el registro en tabla_persona
            Persona::create([
                'cedula_identidad'     => $request->cedula_identidad,
                'nombres'              => $request->nombres,
                'apellidos'            => $request->apellidos,
                'correo'               => $request->correo,
                'telefono'             => $request->telefono,
                'direccion_habitacion' => $request->direccion_habitacion,
            ]);

            // 2. Crear el registro en la tabla del rol correspondiente
            match ($request->rol) {
                'estudiante'     => Estudiante::create(['cedula_persona_fk' => $request->cedula_identidad, 'es_becado' => false]),
                'profesor'       => Profesor::create(['cedula_persona_fk' => $request->cedula_identidad]),
                'representante'  => Representante::create(['cedula_persona_fk' => $request->cedula_identidad]),
                default          => null, // admin no tiene tabla propia de rol
            };

            // 3. Crear el usuario en la tabla users
            $tempPassword = Str::random(10);

            User::create([
                'name'             => $request->nombres . ' ' . $request->apellidos,
                'email'            => $request->correo,
                'password'         => Hash::make($tempPassword),
                'role'             => $request->rol,
                'cedula_persona_fk'=> $request->cedula_identidad,
                'estado_cuenta'    => 'Activo',
            ]);
        });

        return redirect()->route('admin.personas.index')
            ->with('success', 'Persona y cuenta de usuario creadas exitosamente.');
    }

    public function edit($id)
    {
        $this->authorize('edit-persona');
        $persona = Persona::with('user')->findOrFail($id);
        $roles = Role::all();
        return view('admin.personas.edit', compact('persona', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit-persona');
        $persona = Persona::with('user')->findOrFail($id);

        $request->validate([
            'nombres'              => 'required|string|max:255',
            'apellidos'            => 'required|string|max:255',
            'correo'               => 'required|email|unique:tabla_persona,correo,' . $id . ',cedula_identidad|unique:users,email,' . ($persona->user ? $persona->user->id : 'NULL'),
            'telefono'             => 'required|string|max:20',
            'direccion_habitacion' => 'required|string|max:500',
            'rol'                  => 'required|exists:roles,slug',
            'estado_cuenta'        => 'nullable|in:Activo,Inactivo',
        ], [
            'nombres.required'              => 'El nombre es obligatorio.',
            'apellidos.required'            => 'Los apellidos son obligatorios.',
            'correo.required'               => 'El correo electrónico es obligatorio.',
            'correo.email'                  => 'Ingrese un correo electrónico válido.',
            'correo.unique'                 => 'Ese correo ya está registrado en el sistema.',
            'telefono.required'             => 'El teléfono es obligatorio.',
            'direccion_habitacion.required' => 'La dirección de habitación es obligatoria.',
            'estado_cuenta.in'              => 'El estado de la cuenta no es válido.',
            'rol.required'                  => 'Debe seleccionar un rol.',
            'rol.exists'                    => 'El rol seleccionado no es válido.',
        ]);

        DB::transaction(function () use ($request, $persona, $id) {
            // 1. Actualizar tabla_persona
            $persona->update([
                'nombres'              => $request->nombres,
                'apellidos'            => $request->apellidos,
                'correo'               => $request->correo,
                'telefono'             => $request->telefono,
                'direccion_habitacion' => $request->direccion_habitacion,
            ]);

            // 2. Manejar cambio de rol
            if ($persona->user && $request->rol !== $persona->user->role) {
                // Borrar el registro del rol anterior
                match ($persona->user->role) {
                    'estudiante'     => Estudiante::where('cedula_persona_fk', $id)->delete(),
                    'profesor'       => Profesor::where('cedula_persona_fk', $id)->delete(),
                    'representante'  => Representante::where('cedula_persona_fk', $id)->delete(),
                    default          => null,
                };

                // Crear el registro del nuevo rol
                match ($request->rol) {
                    'estudiante'     => Estudiante::create(['cedula_persona_fk' => $id, 'es_becado' => false]),
                    'profesor'       => Profesor::create(['cedula_persona_fk' => $id]),
                    'representante'  => Representante::create(['cedula_persona_fk' => $id]),
                    default          => null,
                };

                // Actualizar rol en user
                $persona->user->role = $request->rol;
            }

            // 3. Actualizar user (si existe)
            if ($persona->user) {
                $userData = [
                    'name'  => $request->nombres . ' ' . $request->apellidos,
                    'email' => $request->correo,
                    'role'  => $request->rol, // Added this line
                ];
                if ($request->has('estado_cuenta')) {
                    $userData['estado_cuenta'] = $request->estado_cuenta;
                }
                $persona->user->update($userData);
            }
        });

        return redirect()->route('admin.personas.index')
            ->with('success', 'Persona actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $this->authorize('delete-persona');
        $persona = Persona::with('user')->findOrFail($id);

        DB::transaction(function () use ($persona) {
            // Soft delete user (si existe)
            if ($persona->user) {
                // Cambiar estado a inactivo para prevenir cualquier sesión activa
                $persona->user->update(['estado_cuenta' => 'Inactivo']);
                $persona->user->delete();
            }
            // Soft delete persona
            $persona->delete();
        });

        return redirect()->route('admin.personas.index')
            ->with('success', 'La persona ha sido dada de baja del sistema exitosamente.');
    }
}
