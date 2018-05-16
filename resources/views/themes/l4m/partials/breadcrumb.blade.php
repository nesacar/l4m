@if(!empty($breadcrumb))
  {!! $breadcrumb !!}
@else
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Shop</a></li>
    <li class="breadcrumb-item active" aria-current="page">Fashion</li>
  </ol>
</nav>
@endif