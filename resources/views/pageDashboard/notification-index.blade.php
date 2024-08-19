<!-- notification-item.php -->
<div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
    <div>
        <h2 class="font-semibold text-[12px]">{{ $notification->title}}</h2>
        <h2 class="font-light text-[10px]">{{ $notification->message}}</h2>
    </div>
    <div class="flex items-center">
        @if($notification->status === 'Success')
        <span class="text-white lg:text-sm md:text-sm sm:text-sm text-xs border border-grey-300 rounded-full px-2 py-1 bg-green-600">Success</span>
        @else
        <span class="text-white lg:text-sm md:text-sm sm:text-sm text-xs border border-grey-300 rounded-full px-2 py-1 bg-red-500">Failed</span>
        @endif
    </div>
</div>