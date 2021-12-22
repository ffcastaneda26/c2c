<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">{{__('Name:')}}</label>
                            <input type="text" wire:model="name" placeholder="{{__('Name')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">{{__('Description:')}}</label>
                            <input type="text" wire:model="description" placeholder="{{__('Description')}}"
                                    maxlength="500"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >
                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label  class="inline text-sm  mb-2">{{__("Image")}}:</label>
                            <input type="file" wire:model.lazy="imagex" id="selecPhoto" accept="photo/*" class="rounded-lg text-sm">
                            @if($image)
                                <img class="h-6 w-6 rounded-full object-cover" src="{{Storage::url($image)}}" />
                            @else
                                <img id="imagenPhoto" class="h-6 w-6 rounded-full object-cover inline">
                            @endif
                            @error('imagex') <span class="text-red-700 text-2xl">{{'*'}}</span>@enderror
                        </div>

                        <div class="mb-4">

                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">{{__('Language')}}</label>
                            <span class="ml-25">
                                <select wire:model="language" class="ml-50">
                                    <option value="" selected disabled>{{ __('Choose') }}</option>
                                    <option value="es">{{ __('Spanish') }}</option>
                                    <option value="en">{{ __('English') }}</option>
                                </select>
                            </span>
                            @error('language') <span class="text-theme-15">{{ $message }}</span> @enderror
                        </div>


                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-blue-500 px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:text-black focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        {{__('Save')}}
                        </button>
                    </span>

                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-500 text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        {{__('Cancel')}}
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    // Obtener referencia al input y a la imagen
    const $selecPhoto = document.querySelector("#selecPhoto"),
    //Imagenes

        $imagenPhoto = document.querySelector("#imagenPhoto");
      // Escuchar cuando cambie
      if ($selecPhoto && $imagenPhoto) {
        $selecPhoto.addEventListener("change", () => {
          // Los archivos seleccionados, pueden ser muchos o uno
          const archivos = $selecPhoto.files;
          // Si no hay archivos salimos de la función y quitamos la imagen
          if (!archivos || !archivos.length) {
            $imagenPhoto.src = "";
            return;
          }
          // Ahora tomamos el primer archivo, el cual vamos a previsualizar
          const primerArchivo = archivos[0];
          // Lo convertimos a un objeto de tipo objectURL
          const objectURL = URL.createObjectURL(primerArchivo);
          // Y a la fuente de la imagen le ponemos el objectURL
          $imagenPhoto.src = objectURL;
        });
    }

    // Obtener referencia al input y a la imagen
      const $selecImage = document.querySelector("#selecImage"),
      //Imagenes 2
      $imagenPrev = document.querySelector("#imagenPrev");
      // Escuchar cuando cambie
      if ($selecImage && $imagenPrev) {
        $selecImage.addEventListener("change", () => {
          // Los archivos seleccionados, pueden ser muchos o uno
          const archivos = $selecImage.files;
          // Si no hay archivos salimos de la función y quitamos la imagen
          if (!archivos || !archivos.length) {
            $imagenPrev.src = "";
            return;
          }
          // Ahora tomamos el primer archivo, el cual vamos a previsualizar
          const primerArchivo = archivos[0];
          // Lo convertimos a un objeto de tipo objectURL
          const objectURL = URL.createObjectURL(primerArchivo);
          // Y a la fuente de la imagen le ponemos el objectURL
          $imagenPrev.src = objectURL;
        });
    }

    // Obtener referencia al input y a la imagen
      const $selecImage1 = document.querySelector("#selecImage1"),
    //Imagenes 3

        $imagenPrev1 = document.querySelector("#imagenPrev1");
      // Escuchar cuando cambie
      if ($selecImage1 && $imagenPrev1) {
        $selecImage1.addEventListener("change", () => {
          // Los archivos seleccionados, pueden ser muchos o uno
          const archivos = $selecImage1.files;
          // Si no hay archivos salimos de la función y quitamos la imagen
          if (!archivos || !archivos.length) {
            $imagenPrev1.src = "";
            return;
          }
          // Ahora tomamos el primer archivo, el cual vamos a previsualizar
          const primerArchivo = archivos[0];
          // Lo convertimos a un objeto de tipo objectURL
          const objectURL = URL.createObjectURL(primerArchivo);
          // Y a la fuente de la imagen le ponemos el objectURL
          $imagenPrev1.src = objectURL;
        });
    }
    </script>
