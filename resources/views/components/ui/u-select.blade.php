@props([
    'options' => [],
    'name' => '',
    ])
<select name="{{ $name }}" class="px-4 py-2 border-solid border-primary border bg-white text-primary rounded-lg outline-none" >
    <option value="null">Выберите вариант</option>
    @foreach($options as $option)
        <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
    @endforeach
</select>