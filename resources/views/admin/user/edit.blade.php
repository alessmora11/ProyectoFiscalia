<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between"> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit user') }}                            
        </h2>   
        <a href="{{ route('users') }}" class="hover:bg-light-blue-200 hover:text-light-blue-800 group flex items-center rounded-md bg-light-blue-100 text-light-blue-600 text-sm font-medium px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>      
            &nbsp;  
            {{ __('Back') }}        
        </a>        
    </div>          
    </x-slot>       

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">      
                          @csrf
                          <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                              <div class="grid grid-cols-6 gap-6">   
                                <div class="col-span-12 sm:col-span-12"> 
                                  <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                  <input type="text" name="name" value="{{ $user->name }}" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div> 
                                <div class="col-span-12 sm:col-span-12"> 
                                  <label for="email" class="block text-sm font-medium text-gray-700">Correo electronico</label>
                                  <input type="text" name="email" value="{{ $user->email }}" id="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-12 sm:col-span-12"> 
                                  <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                                  <input type="password" name="password" value="{{ $user->password }}" id="password" autocomplete="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-12 sm:col-span-12">
                                  @if ($user->image)
                                    <img src="{{ Storage::url($user->image->url) }}"  width="500" height="500">
                                  @else
                                    Sin imagen
                                  @endif
                                </div>

                                <div class="col-span-12 sm:col-span-12">
                                  <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                                  <input type="file" name="image" id="image" class="mt-1 focus:ring-indigo-500 block w-full">   
                                </div>

                                <div class="px-4 py-5 bg-white sm:p-6">
                                  <label for="roles" class="block text-sm font-medium text-gray-700">Rol</label>
                                  <select name="roles[]" id="roles">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}"> 
                                      {{ $role->name }}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>

                            </div>      
                            <div class="px-4 py-3 bg-white text-right sm:px-6"> 
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Update') }}    
                              </button> 
                            </div>      
                          </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>      
    </div>           
    
    
</x-app-layout>