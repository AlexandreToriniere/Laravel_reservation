<x-guest-layout>
    {{-- <div class="flex item-center ">
    @foreach ($prestations as $prestation )      
            <div class="bg-white font-semibold text-center rounded-3xl border shadow-lg p-10 max-w-xs">
                <img class="mb-3 w-32 h-32 rounded-full shadow-lg mx-auto" src="{{ Storage::url($prestation->image) }}" alt="product designer">
                <h1 class="text-lg text-gray-700"> {{$prestation->name}} </h1>
                <h3 class="text-sm text-gray-400 ">{{$prestation->price}}  </h3>
                <p class="text-xs text-gray-400 mt-4">{{$prestation->description}}  </p>
                <button class="bg-indigo-600 px-8 py-2 mt-8 rounded-3xl text-gray-100 font-semibold uppercase tracking-wide">Hire Me</button>
            </div>
    @endforeach 
    <div>   --}}
        <!--Posts Container-->
				<div class="flex flex-wrap justify-between pt-12 -mx-6">
                    @foreach ($prestations as $prestation )
                        
                    
					<!--1/3 col -->
					<div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
						<div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
							<a href="#" class="flex flex-wrap no-underline hover:no-underline">
								<img src="{{ Storage::url($prestation->image) }}" class="h-64 w-full rounded-t pb-6">
								<p class="w-full text-gray-600 text-xs md:text-sm px-6">{{$prestation->name}}</p>
								<div class="w-full font-bold text-xl text-gray-900 px-6">{{$prestation->price}} €</div>
								<p class="text-gray-800 font-serif text-base px-6 mb-5">
									{{$prestation->description}}
								</p>
							</a>
						</div>
					</div>
                    @endforeach
				</div>
				<!--/ Post Content-->
						
			</div>
</x-guest-layout>    