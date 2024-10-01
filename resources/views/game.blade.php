@extends('layouts.app')

@section('style')
@vite(['resources/sass/game.scss'])
@endsection

@section('content')
</style>
<div class="tablero">
    @foreach ($cards as $card)
    <div class="card-emogi" data-id="{{$card['id']}}" data-num="{{$card['num']}}">
        <div class="card-svg d-none">
            {!! $card['svg'] !!}
        </div>
        <div class="card-null text-center h-100 bg-white rounded">
            <svg width="55%" height="55%" viewBox="0 0 36 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.046 0C10.2512 0 5.20247 3.19365 1.2387 8.88926C0.519656 9.92246 0.741335 11.3391 1.74436 12.0996L5.95706 15.2938C6.97005 16.0619 8.41136 15.8823 9.20442 14.8888C11.6506 11.8242 13.4652 10.0598 17.2862 10.0598C20.2905 10.0598 24.0065 11.9933 24.0065 14.9065C24.0065 17.1089 22.1884 18.2399 19.222 19.903C15.7627 21.8425 11.185 24.2562 11.185 30.2941V31.25C11.185 32.5444 12.2343 33.5938 13.5287 33.5938H20.606C21.9004 33.5938 22.9497 32.5444 22.9497 31.25V30.6862C22.9497 26.5007 35.1829 26.3264 35.1829 15C35.183 6.47031 26.3352 0 18.046 0ZM17.0674 36.4706C13.3373 36.4706 10.3027 39.5053 10.3027 43.2354C10.3027 46.9653 13.3373 50 17.0674 50C20.7975 50 23.8322 46.9653 23.8322 43.2353C23.8322 39.5052 20.7975 36.4706 17.0674 36.4706Z" fill="#0098AE" />
            </svg>

        </div>
    </div>
    @endforeach
</div>

<div class="modal" data-bs-backdrop="static" id="modal-win" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary p-3 d-flex justify-content-between">
                <div class="d-flex gap-2 align-items-center">
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0C4.97754 0 0.5 4.47915 0.5 10C0.5 15.5241 4.97754 20 10.5 20C16.0225 20 20.5 15.5241 20.5 10C20.5 4.47915 16.0225 0 10.5 0ZM10.5 4.43548C11.4353 4.43548 12.1935 5.19371 12.1935 6.12903C12.1935 7.06435 11.4353 7.82258 10.5 7.82258C9.56468 7.82258 8.80645 7.06435 8.80645 6.12903C8.80645 5.19371 9.56468 4.43548 10.5 4.43548ZM12.7581 14.6774C12.7581 14.9446 12.5414 15.1613 12.2742 15.1613H8.72581C8.45859 15.1613 8.24194 14.9446 8.24194 14.6774V13.7097C8.24194 13.4425 8.45859 13.2258 8.72581 13.2258H9.20968V10.6452H8.72581C8.45859 10.6452 8.24194 10.4285 8.24194 10.1613V9.19355C8.24194 8.92633 8.45859 8.70968 8.72581 8.70968H11.3065C11.5737 8.70968 11.7903 8.92633 11.7903 9.19355V13.2258H12.2742C12.5414 13.2258 12.7581 13.4425 12.7581 13.7097V14.6774Z" fill="white" />
                    </svg>
                    <h4 class="fw-bold text-white m-0">Fin de la partida</h4>
                </div>

                <div class="font-spicy text-white gap-1 d-flex fs-4">
                    Tiempo:
                    <input id="total-time" class="form-control border-secondary" readonly name="name" required type="text">
                </div>
            </div>
            <div class="modal-body">
                <p class="mb-3">Ingresa tus datos para almacenar tu puntaje</p>
                <form id="form-save-player" action="{{route('player.save')}}" method="POST">
                        <div class="d-flex gap-3">
                        <div class="w-75 d-flex flex-column gap-3">
                            <label class="w-100 font-spicy d-flex align-items-center gap-2 fs-5">
                                <span class="w-25">
                                    Nombre:
                                </span>
                                <input class="form-control bg-secondary text-white border-light" name="name" required type="text">
                            </label>
                            <label class="w-100 font-spicy d-flex align-items-center gap-2 fs-5">
                                <span class="w-25">
                                    Email:
                                </span>
                                <input class="form-control bg-secondary text-white border-light" name="email" required type="email">
                            </label>
                        </div>
                        <div class="w-25">
                            <button id="btn-save-player" class="btn bg-secondary border-light w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white fw-bold">
                                <svg width="24" height="24" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.4351 3.93513L14.0649 0.56487C13.7032 0.203193 13.2127 2.67459e-06 12.7012 0H1.92857C0.863438 0 0 0.863438 0 1.92857V16.0714C0 17.1366 0.863438 18 1.92857 18H16.0714C17.1366 18 18 17.1366 18 16.0714V5.29883C18 4.78734 17.7968 4.2968 17.4351 3.93513ZM10.9286 1.92857V5.14286H5.78571V1.92857H10.9286ZM15.8304 16.0714H2.16964C2.10571 16.0714 2.04439 16.046 1.99918 16.0008C1.95397 15.9556 1.92857 15.8943 1.92857 15.8304V2.16964C1.92857 2.10571 1.95397 2.04439 1.99918 1.99918C2.04439 1.95397 2.10571 1.92857 2.16964 1.92857H3.85714V6.10714C3.85714 6.63971 4.28886 7.07143 4.82143 7.07143H11.8929C12.4254 7.07143 12.8571 6.63971 12.8571 6.10714V2.08454L16.0008 5.22824C16.0232 5.25063 16.041 5.2772 16.0531 5.30645C16.0652 5.3357 16.0714 5.36705 16.0714 5.39871V15.8304C16.0714 15.8943 16.046 15.9556 16.0008 16.0008C15.9556 16.046 15.8943 16.0714 15.8304 16.0714ZM9 8.03571C7.05042 8.03571 5.46429 9.62184 5.46429 11.5714C5.46429 13.521 7.05042 15.1071 9 15.1071C10.9496 15.1071 12.5357 13.521 12.5357 11.5714C12.5357 9.62184 10.9496 8.03571 9 8.03571ZM9 13.1786C8.11382 13.1786 7.39286 12.4576 7.39286 11.5714C7.39286 10.6852 8.11382 9.96429 9 9.96429C9.88618 9.96429 10.6071 10.6852 10.6071 11.5714C10.6071 12.4576 9.88618 13.1786 9 13.1786Z" fill="#F9F9F9" />
                                </svg>
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-nowrap">
                <button id="btn-delete-card" type="button" class="btn btn-success w-50 d-flex align-items-center justify-content-center gap-2">
                    <svg width="24" height="24" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.99997 10L3.85524 6.30263L0.986816 3.81579L4.77629 3.48684L6.24997 0L7.72366 3.48684L11.5131 3.81579L8.64471 6.30263L9.49997 10L6.24997 8.03947L2.99997 10Z" fill="white" />
                    </svg>
                    <span style="padding-top: 0.2rem">
                        Tabla de puntaje
                    </span>
                </button>
                <button type="button" class="btn btn-success w-50 d-flex align-items-center justify-content-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.88123 3.35405L1.38145 0.10262C0.934591 -0.161432 0.250244 0.0948078 0.250244 0.747906V7.2492C0.250244 7.83512 0.886156 8.18823 1.38145 7.89449L6.88123 4.64462C7.37183 4.35557 7.37339 3.6431 6.88123 3.35405Z" fill="white" />
                    </svg>
                    <span style="padding-top: 0.2rem">
                        Volver a jugar
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    window.total = @json($total);

</script>
@vite(['resources/js/game.js'])
@endsection
