<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class UButton extends Component
{
    private $color;
    private $text;
    private $size;

    private $bgColors = [
        'white' => 'bg-white',
        'info' => 'bg-info',
        'primary' => 'bg-primary',
        'secondary' => 'bg-secondary',
        'accent' => 'bg-accent',
    ];

    private $textColors = [
        'white' => 'text-white',
        'info' => 'text-info',
        'primary' => 'text-primary',
        'secondary' => 'text-secondary',
        'accent' => 'text-accent',
    ];

    private $sizes = [
        'small' => 'h-6',
        'medium' => 'h-9',
        'large' => 'h-14',
    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $color = 'info', bool $text = false, string $size = 'medium')
    {
        $this->color = $color;
        $this->text = $text;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            'background' =>
                $this->text ?
                    $this->bgColors['white'] :
                    $this->bgColors[$this->color],
            'textColor' =>
                $this->text ?
                    $this->textColors[$this->color] :
                    $this->textColors['white'],
            'size' => $this->sizes[$this->size],
        ];
        return view('components.ui.u-button', $data);
    }
}
