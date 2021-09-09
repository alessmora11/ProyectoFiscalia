<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between"> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users list') }}                       
        </h2>
        <a type="button" href="{{route('users.create')}}" class="hover:bg-light-blue-200 hover:text-light-blue-800 group flex items-center rounded-md bg-light-blue-100 text-light-blue-600 text-sm font-medium px-4 py-2">    
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>    
            {{ __('Add') }}                 
        </a>      
    </div>  
    </x-slot>   

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">      
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">      
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Correo electronico
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha creación
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Imagen
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rol
                                </th>                          
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                                </tr>   
                            </thead>    
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>     
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->name }}                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->email }}                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->created_at }}    
                                </td>
                                <td class="px-6 py-4">
                                    @if ($user->image)
                                    <img src="{{ Storage::url($user->image->url) }}">
                                    @else
                                    Sin imagen
                                    @endif
                                </td> 
                                <td class="px-6 py-4">
                                    @foreach ($user->roles as $role)
                                    <span>
                                        {{ $role->name }}
                                    </span>
                                    @endforeach
                                </td>       
                                <td class="px-6 py-4 whitespace-nowrap">            
                                    <a type="button" href="{{route('users.edit', $user->id)}}" class="inline-flex items-center px-4 py-2 border border-current rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Editar</a>       
                                    <a type="button" href="{{route('users.destroy', $user->id)}}" class="inline-flex items-center px-4 py-2 border border-current rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Eliminar</a>
                                </td>               
                                </tr>                                               
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col py-4">        
                    {{ $users->links() }}                       
                </div>                
            </div>
        </div>      
    </div>      
</x-app-layout>
