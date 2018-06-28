<div class="accordion product_description">

    @if($product->body)
        <div class="accordion_pane product_description-section">
            <button class="js-accordion_toggle product_description-tab"
                    aria-controls="#_sub-id-1"
                    aria-expanded="true"
            >
                O PROIZVODU
                <svg class="icon">
                    <use xlink:href="#icon_arrow">
                </svg>
            </button>
            <div class="accordion_wrapper" id="_sub-id-1">
                <div class="accordion_content product_description-content">
                    {!! $product->body !!}
                </div>
            </div>
        </div>
    @endif

    @if($product->body2)
        <div class="accordion_pane product_description-section">
            <button class="js-accordion_toggle product_description-tab"
                    aria-controls="#_sub-id-2"
            >
                ISPORUKA I POVRAĆAJ
                <svg class="icon">
                    <use xlink:href="#icon_arrow">
                </svg>
            </button>
            <div class="accordion_wrapper" id="_sub-id-2">
                <div class="accordion_content product_description-content">
                    {!! $product->body2 !!}
                </div>
            </div>
        </div>
    @endif

</div>
