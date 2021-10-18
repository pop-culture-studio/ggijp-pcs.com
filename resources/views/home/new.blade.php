<h2 class="text-3xl">新着</h2>

<div class="m-1 flex flex-wrap gap-4">
    <x-new-item :image="asset('images/01.png')" name="1 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."></x-new-item>
    <x-new-item :image="asset('images/02.png')" name="2"></x-new-item>
    <x-new-item :image="asset('images/03.png')" name="3"></x-new-item>
    <x-new-item :image="asset('images/04.png')" name="4"></x-new-item>
    <x-new-item :image="asset('images/05.png')" name="5"></x-new-item>
    <x-new-item :image="asset('images/06.png')" name="6"></x-new-item>
    <x-new-item :image="asset('images/07.png')" name="7"></x-new-item>
    <x-new-item :image="asset('images/08.png')" name="8"></x-new-item>
    <x-new-item image="{{ $i ?? '' }}" name="9"></x-new-item>
 </div>
