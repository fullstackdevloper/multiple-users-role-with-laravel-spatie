<div class="bt" 
    x-data="{showModal : false, id : ''}" 
    x-show="showModal" 
    x-on:open-subscription-modal.window="showModal=true , id = event.detail"
    x-on:close-modal.window="showModal=false"
    
>   
<div  @click.away="showModal = false"  class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-auto">
        <!-- Modal content -->
        <div class="relative">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Pay to Subscribe</h3>
                <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 flex items-center justify-center">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            {{$slot}}
        </div>
    </div>
</div>
</div>