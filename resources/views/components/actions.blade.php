@props(['chirp'])
<div class="w-full flex justify-end items-center gap-5">
    <x-favorites :chirp="$chirp"></x-favorites>
    <x-reply :chirp="$chirp"></x-reply>
</div>
