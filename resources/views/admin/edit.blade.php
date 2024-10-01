@extends('layouts.app')

@section('style')
    @vite(['resources/sass/create.scss'])
@endsection

@section('content')
<div>
    <form action="{{route('cards.update', $card->id)}}" method="POST">
        @method('put')
        @csrf
        <div class="bg-primary p-3 shadow d-flex justify-content-between">
            <div class="d-flex gap-2 align-items-center">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5 0C4.97754 0 0.5 4.47915 0.5 10C0.5 15.5241 4.97754 20 10.5 20C16.0225 20 20.5 15.5241 20.5 10C20.5 4.47915 16.0225 0 10.5 0ZM10.5 4.43548C11.4353 4.43548 12.1935 5.19371 12.1935 6.12903C12.1935 7.06435 11.4353 7.82258 10.5 7.82258C9.56468 7.82258 8.80645 7.06435 8.80645 6.12903C8.80645 5.19371 9.56468 4.43548 10.5 4.43548ZM12.7581 14.6774C12.7581 14.9446 12.5414 15.1613 12.2742 15.1613H8.72581C8.45859 15.1613 8.24194 14.9446 8.24194 14.6774V13.7097C8.24194 13.4425 8.45859 13.2258 8.72581 13.2258H9.20968V10.6452H8.72581C8.45859 10.6452 8.24194 10.4285 8.24194 10.1613V9.19355C8.24194 8.92633 8.45859 8.70968 8.72581 8.70968H11.3065C11.5737 8.70968 11.7903 8.92633 11.7903 9.19355V13.2258H12.2742C12.5414 13.2258 12.7581 13.4425 12.7581 13.7097V14.6774Z" fill="white" />
                </svg>
                <h4 class="fw-bold text-white m-0">Editar carta</h4>
            </div>

            <button class="btn bg-success text-white d-flex gap-2 align-items-center">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.8724 4.37237L16.1276 0.627634C15.7258 0.225769 15.1807 2.97177e-06 14.6124 0H2.64286C1.45938 0 0.5 0.959375 0.5 2.14286V17.8571C0.5 19.0406 1.45938 20 2.64286 20H18.3571C19.5406 20 20.5 19.0406 20.5 17.8571V5.88759C20.5 5.31927 20.2742 4.77423 19.8724 4.37237ZM12.6429 2.14286V5.71429H6.92857V2.14286H12.6429ZM18.0893 17.8571H2.91071C2.83967 17.8571 2.77154 17.8289 2.72131 17.7787C2.67108 17.7285 2.64286 17.6603 2.64286 17.5893V2.41071C2.64286 2.33967 2.67108 2.27154 2.72131 2.22131C2.77154 2.17108 2.83967 2.14286 2.91071 2.14286H4.78571V6.78571C4.78571 7.37746 5.2654 7.85714 5.85714 7.85714H13.7143C14.306 7.85714 14.7857 7.37746 14.7857 6.78571V2.31616L18.2787 5.80915C18.3036 5.83403 18.3233 5.86356 18.3368 5.89606C18.3502 5.92856 18.3571 5.96339 18.3571 5.99857V17.5893C18.3571 17.6603 18.3289 17.7285 18.2787 17.7787C18.2285 17.8289 18.1603 17.8571 18.0893 17.8571ZM10.5 8.92857C8.33379 8.92857 6.57143 10.6909 6.57143 12.8571C6.57143 15.0233 8.33379 16.7857 10.5 16.7857C12.6662 16.7857 14.4286 15.0233 14.4286 12.8571C14.4286 10.6909 12.6662 8.92857 10.5 8.92857ZM10.5 14.6429C9.51536 14.6429 8.71429 13.8418 8.71429 12.8571C8.71429 11.8725 9.51536 11.0714 10.5 11.0714C11.4846 11.0714 12.2857 11.8725 12.2857 12.8571C12.2857 13.8418 11.4846 14.6429 10.5 14.6429Z" fill="#F9F9F9" />
                </svg>
                Guardar
            </button>
        </div>

        <div class="row mt-3">
            <div class="col col-md-6">
                <label class="w-100 font-spicy text-white d-flex flex-column fs-4">
                    Nombre
                    <input class="form-control bg-primary" value="{{$card->name}}" name="name" required type="text">
                </label>
                <label class="w-100 font-spicy text-white d-flex flex-column fs-4">
                    SVG
                    <textarea id="txtSvg" class="form-control bg-primary" required name="svg" id="" cols="30" rows="10">
                        {{$card->svg}}
                    </textarea>
                </label>
            </div>

            <div class="col col-md-6">
                <div class="container-preview-svg d-flex justify-content-center align-items-center bg-white h-100 w-100">
                    <div class="preview-svg w-50">
                        {!!$card->svg!!}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
@vite(['resources/js/create.js'])
@endsection