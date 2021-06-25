<div class="hidden z-10 inset-0 overflow-y-auto" id="modal-register-{{$pegawai->id}}">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-1/2"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white p-10">
                <form method="POST" action="{{route('update',$pegawai->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="lg:flex lg:justify-between">
                        <div class="w-full lg:w-1/2 mb-6 mr-2">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="first_name">
                                First Name
                            </label>

                            <input class="border border-gray-400 p-2 w-full" type="text" name="first_name"
                                id="first_name" placeholder="John" value="{{$pegawai->first_name}}" required>
                            @error('first_name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full lg:w-1/2 mb-6">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="last_name">
                                Last Name
                            </label>

                            <input class="border border-gray-400 p-2 w-full" type="text" name="last_name" id="last_name"
                                placeholder="Doe" value="{{$pegawai->last_name}}" required>
                            @error('last_name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700">
                            Photo
                        </label>
                        <div class="mt-2 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 mr-2">
                                <img src="{{asset('pegawais/images/' . $pegawai->image)}}" alt="">
                            </span>
                            <input class="border border-gray-400 p-2 w-full" type="file" name="image" id="image"
                                accept=".jpg, .png, .jpeg" placeholder="Enter your name">
                        </div>
                        @error('image')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">
                            Email
                        </label>

                        <input class="border border-gray-400 p-2 w-full" type="email" name="email" id="email"
                            placeholder="john.doe@example.com" value="{{$pegawai->email}}" required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                        <div class="w-full lg:w-1/2 mb-6">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="section">
                                Section
                            </label>

                            <input class="border border-gray-400 p-2 w-full" type="text" name="section" id="section"
                                placeholder="A" value="{{$pegawai->section}}" required>
                            @error('section')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="lg:flex">
                        <div class="w-full lg:w-1/2 mb-6 mr-2">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="blood_group">
                                Blood Group
                            </label>

                            <select class="border border-gray-400 p-2 w-full" name="blood_group" id="blood_group"
                                required>
                                <option>--- Blood Group ---</option>
                                <option value="A+" @if ($pegawai->blood_group == "A+") selected @endif>A+</option>
                                <option value="A-" @if ($pegawai->blood_group == "A-") selected @endif>A-</option>
                                <option value="B+" @if ($pegawai->blood_group == "B+") selected @endif>B+</option>
                                <option value="B-" @if ($pegawai->blood_group == "B-") selected @endif>B-</option>
                                <option value="AB+" @if ($pegawai->blood_group == "AB+") selected @endif>AB+</option>
                                <option value="AB-" @if ($pegawai->blood_group == "AB-") selected @endif>AB-</option>
                                <option value="O+" @if ($pegawai->blood_group == "O+") selected @endif>O+</option>
                                <option value="O-" @if ($pegawai->blood_group == "O-") selected @endif>O-</option>
                            </select>
                            @error('blood_group')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full lg:w-1/2 mb-6">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="mobile_no">
                                Mobile No
                            </label>

                            <input class="border border-gray-400 p-2 w-full" type="text" name="mobile_no" id="mobile_no"
                                placeholder="+8801xxxxxxxxx" value="{{$pegawai->mobile_no}}" required>
                            @error('mobile_no')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="current_address">
                            Current_Address
                        </label>

                        <textarea class="border border-gray-400 p-2 w-2/3 p-4" rows="5" name="current_address"
                            id="current_address" placeholder="1020 Louelda St, Winnipeg, MB R2K 3Z4, Canada"
                            required>{!!$pegawai->current_address!!}</textarea>
                        @error('current_address')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex">
                        <div class="mr-2">
                            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                                Submit
                            </button>
                        </div>
                        <div class="mx-2">
                            <button
                                onclick="document.querySelector('#modal-register-{{$pegawai->id}}').classList.remove('fixed');document.querySelector('#modal-register-{{$pegawai->id}}').classList.add('hidden');"
                                type="button" class="bg-red-400 text-white rounded py-2 px-4 hover:bg-red-500">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>