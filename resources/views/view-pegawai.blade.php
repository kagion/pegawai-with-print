<div class="hidden z-10 inset-0 overflow-y-auto" id="modal-view-{{$pegawai->id}}">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="w-full">
                <span class="border border-1 border-gray-500 rounded-full bg-gray-300 float-right cursor-pointer m-1"
                    onclick="document.querySelector('#modal-view-{{$pegawai->id}}').classList.remove('fixed');document.querySelector('#modal-view-{{$pegawai->id}}').classList.add('hidden');">
                    <svg class="w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
            <div class="bg-white p-10">
                <div class="border border-1 border-gray-300 mx-auto rounded-md relative"
                    style="width: 346px; height: 216px;">
                    <img class="rounded-md absolute" style="height: 214px;" src="{{asset('images/Front.jpg')}}" alt=""
                        width="346">
                    <div class="rounded-md absolute"
                        style="width: 346px; height: 216px; font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;">
                        <div class="flex justify-between mt-6">
                            <div class="px-3">
                                <span class="text-md"></span><br>
                                <span class="text-md"></span><br>
                                <span class="text-md capitalize text-light">{{$pegawai->first_name. " " . $pegawai->last_name}}</span><br>
                                <span class="text-md">ID: {{str_pad($pegawai->id+1, 4, '0', STR_PAD_LEFT)}}</span><br>
                                <span class="text-md">Section: {{$pegawai->section}}</span><br>
                            </div>
                            <div class="mx-4">
                                <img class="mx-auto mb-2" style="height: 80px;"
                                    src="{{asset('pegawais/images/' . $pegawai->image)}}" alt="" width="75">
                                <div class="flex items-center">
                                    <span>
                                        <svg class="w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M17.924 2.617a.997.997 0 00-.215-.322l-.004-.004A.997.997 0 0017 2h-4a1 1 0 100 2h1.586l-3.293 3.293a1 1 0 001.414 1.414L16 5.414V7a1 1 0 102 0V3a.997.997 0 00-.076-.383z" />
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs ml-2">{{$pegawai->mobile_no}}</span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <span>
                                        <svg class="w-3" id="Layer_1" enable-background="new 0 0 511.866 511.866"
                                            viewBox="0 0 511.866 511.866" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m409.394 248.314-145.677-241.072c-2.754-4.557-7.714-7.316-13.039-7.241-5.323.071-10.21 2.959-12.841 7.588l-137.796 242.509c-16.375 28.819-23.362 53.552-23.362 82.7 0 98.739 80.413 179.068 179.255 179.068s179.255-80.33 179.255-179.068c-.001-34.692-10.313-58.864-25.795-84.484z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs ml-2">{{$pegawai->blood_group}}</span>
                                </div>
                                <img class="mx-auto" src="{{asset('images/sign.png')}}" alt="" width="45">
                                <div class="border-b border-black border-b-1 w-full"></div>
                                <span class="mx-auto text-center block">Register</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 border border-1 border-gray-300 mx-auto rounded-md relative"
                    style="width: 346px; height: 216px;">
                    <img class="rounded-md absolute" style="height: 214px;" src="{{asset('images/Back.jpg')}}" alt=""
                        width="346">
                
                </div>
            </div>
        </div>
    </div>
</div>