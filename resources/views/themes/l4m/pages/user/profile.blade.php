@extends('themes.' . $theme . '.index')

@section('content')
    <div class="container">
        <div class="checkout">
            <div class="checkout-steps">
                {{-- stepper --}}
                @include('themes.' . $theme . '.pages.user.nav', ['active' => 'profile'])
            </div>
            <div class="checkout-content mb-4 py-1">
                <h3 class="display-3 text--uppercase text--sans-serif">Moj profil</h3>
                @if(!empty($address))
                    <form class="pb-4" method="POST" action="{{ route('edit.address', $address->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="profile" value="1">
                        <div class="mb-2">
                            @textfield([
                              'value' => $address->name,
                              'id' => 'name',
                              'name' => 'name',
                              'label' => 'Ime i prezime',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error_message' => $errors->first('name'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => $address->phone,
                              'id' => 'tel',
                              'name' => 'phone',
                              'label' => 'Telefon',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error_message' => $errors->first('phone'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => $address->address,
                              'id' => 'address',
                              'name' => 'address',
                              'label' => 'Ulica i broj',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error_message' => $errors->first('address'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => $address->town,
                              'id' => 'city',
                              'name' => 'town',
                              'label' => 'Grad',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error_message' => $errors->first('town'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => $address->postcode,
                              'id' => 'postcode',
                              'name' => 'postcode',
                              'label' => 'Poštanski broj',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error_message' => $errors->first('postcode'),
                            ])
                            @endtextfield
                            @selectbox([
                              'id' => 'Država',
                              'name' => 'country',
                              'label' => 'Država',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error_message' => $errors->first('country'),
                            ])
                            <option value="1" {{ $address->country == 1? 'selected' : '' }}>Srbija</option>
                            <option value="2" {{ $address->country == 2? 'selected' : '' }}>Hrvatska</option>
                            @endselectbox
                        </div>
                        <div>
                            <button class="btn btn--primary">Promeni podatke</button>
                        </div>
                    </form>
                @else
                    <form class="pb-4" method="POST" action="{{ route('create.address') }}">
                        @csrf
                        <input type="hidden" name="profile" value="1">
                        <div class="mb-2">
                            @textfield([
                              'value' => '',
                              'id' => 'name',
                              'name' => 'name',
                              'label' => 'Ime i prezime',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error' => $errors->first('name'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => '',
                              'id' => 'tel',
                              'name' => 'phone',
                              'label' => 'Telefon',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error' => $errors->first('phone'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => '',
                              'id' => 'address',
                              'name' => 'address',
                              'label' => 'Ulica i broj',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error' => $errors->first('address'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => '',
                              'id' => 'city',
                              'name' => 'town',
                              'label' => 'Grad',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error' => $errors->first('town'),
                            ])
                            @endtextfield
                            @textfield([
                              'value' => '',
                              'id' => 'postcode',
                              'name' => 'postcode',
                              'label' => 'Poštanski broj',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error' => $errors->first('postcode'),
                            ])
                            @endtextfield
                            @selectbox([
                              'id' => 'Država',
                              'name' => 'country',
                              'label' => 'Država',
                              'helper_text' => 'Ovo polje je obavezno',
                              'required' => true,
                              'error' => $errors->first('country'),
                            ])
                            <option value="1">Srbija</option>
                            <option value="2">Hrvatska</option>
                            @endselectbox
                        </div>
                        <div>
                            <button class="btn btn--primary">Promeni podatke</button>
                        </div>
                    </form>
                @endif

                @if ($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif

                <form class="pb-4" method="POST" action="{{ route('profile.change-password') }}">
                    @csrf
                    <div class="mb-2">
                        @textfield([
                          'value' => '',
                          'id' => 'password',
                          'name' => 'old_password',
                          'label' => 'Lozinka',
                          'type' => 'password',
                          'helper_text' => 'Ovo polje je obavezno',
                          'required' => true,
                          'error' => $errors->first('old_password'),
                          ])
                        @endtextfield
                        @textfield([
                          'value' => '',
                          'id' => 'new_password',
                          'name' => 'password',
                          'label' => 'Nova lozinka',
                          'type' => 'password',
                          'helper_text' => 'Ovo polje je obavezno',
                          'required' => true,
                          'error' => $errors->first('password'),
                          ])
                        @endtextfield
                        @textfield([
                          'value' => '',
                          'id' => 'repeat_password',
                          'name' => 'password_confirmation',
                          'label' => 'Ponovite lozinku',
                          'type' => 'password',
                          'helper_text' => 'Ovo polje je obavezno',
                          'required' => true,
                          'error' => false,
                          ])
                        @endtextfield
                    </div>
                    <div>
                        <button class="btn btn--primary">Promeni lozinku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection