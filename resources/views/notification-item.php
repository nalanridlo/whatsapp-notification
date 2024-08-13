<!-- notification-item.php -->
<div class="flex justify-between items-center border-[#E3E3E3] border-[1px] rounded-[10px] p-[10px]">
    <div>
        <h2 class="font-semibold text-[12px]"><?php echo htmlspecialchars($title); ?></h2>
        <h2 class="font-light text-[10px]"><?php echo htmlspecialchars($message); ?></h2>
    </div>
    <div class="flex items-center">
        <span class="text-black text-sm">Status: </span>
        <span class="text-<?php echo htmlspecialchars($statusColor); ?> text-sm"><?php echo htmlspecialchars($statusText); ?></span>
        <span class="ml-2 h-3 w-3 bg-<?php echo htmlspecialchars($statusColor); ?> rounded-full"></span>
    </div>
</div>