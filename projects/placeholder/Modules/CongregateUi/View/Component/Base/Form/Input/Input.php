<?php

namespace Modules\CongregateUi\View\Component\Base\Form\Input;

use Illuminate\View\Component;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Input extends Component
{
    use RenderTrait;
    use ColorTrait;

    /**
     * @param label
     */
    public function __construct(
        private $type = 'text',
        private ?string $name = null,
        private ?string $id = null,
        private ?string $placeholder = null,
        private ?string $label = null,
        private ?string $row_col = null,
        private ?string $size = null,
        private string $label_row_width = '2',
        private string|array $label_classes = '',
    ) {
    }

    protected $view = 'congregateui::components.base.form.input/base';


    private function preMergeData(array $data)
    {
        $data['name'] = $this->name ?? uniqid('input_');
        $data['type'] = $this->type;
        $data['id'] = $this->id ?? uniqid('input_id_');
        $data['placeholder'] = $this->placeholder;
        $data['label'] = $this->label;
        $this->row_col = $this->attributes->get('row_col', $this->row_col);
        if ($this->row_col === 'row') {
            $data['row_col'] = "row";
        } else {
            $data['row_col'] = "col";
        }
        $data['label_row_width'] =
            $this->attributes->get('label_row_width', $this->label_row_width);
        $data['label_classes'] = (is_Array($this->label_classes) ? join(' ', $this->label_classes) : $this->label_classes) . ($this->size === 'lg' ? ' form-control-lg' : '') . ($this->size === 'sm' ? ' form-control-sm' : '');
        $data['input_classes'] = $this->attributes->get('class', '') . ($this->size === 'lg' ? ' form-control-lg' : '') . ($this->size === 'sm' ? ' form-control-sm' : '');
        return $data;
    }

    public function mergeData($data)
    {
        if ($this->size) {
            $data['classes']['form-control-' . $this->size] = true;
        }
        return $data;
    }
}
