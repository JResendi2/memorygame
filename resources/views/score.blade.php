@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('style')
@vite(['resources/sass/index.scss'])
@endsection
@section('content')
<div>
    <div class="bg-primary p-3 shadow">
        <div class="d-flex gap-2 align-items-center">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 0C4.97754 0 0.5 4.47915 0.5 10C0.5 15.5241 4.97754 20 10.5 20C16.0225 20 20.5 15.5241 20.5 10C20.5 4.47915 16.0225 0 10.5 0ZM10.5 4.43548C11.4353 4.43548 12.1935 5.19371 12.1935 6.12903C12.1935 7.06435 11.4353 7.82258 10.5 7.82258C9.56468 7.82258 8.80645 7.06435 8.80645 6.12903C8.80645 5.19371 9.56468 4.43548 10.5 4.43548ZM12.7581 14.6774C12.7581 14.9446 12.5414 15.1613 12.2742 15.1613H8.72581C8.45859 15.1613 8.24194 14.9446 8.24194 14.6774V13.7097C8.24194 13.4425 8.45859 13.2258 8.72581 13.2258H9.20968V10.6452H8.72581C8.45859 10.6452 8.24194 10.4285 8.24194 10.1613V9.19355C8.24194 8.92633 8.45859 8.70968 8.72581 8.70968H11.3065C11.5737 8.70968 11.7903 8.92633 11.7903 9.19355V13.2258H12.2742C12.5414 13.2258 12.7581 13.4425 12.7581 13.7097V14.6774Z" fill="white" />
            </svg>
            <h4 class="fw-bold text-white m-0">Puntajes</h4>
        </div>
    </div>

    <table class="mx-auto shadow mt-3  w-100">
        <thead class="bg-primary">
            <tr>
                <th class="text-center">Jugador</th>
                <th>
                    <div class="ps-2 text-center">
                        Mejor tiempo
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="bg-secondary">
            @foreach ($games as $game)
            <tr>
                <td>
                    <div class="text-center p-2 border-dark">
                        {{$game->player}}
                    </div>
                </td>
                <td>
                    <div class="td-svg text-center p-2">
                        {{Carbon::createFromFormat('Y-m-d H:i:s', $game->end_time)->diffInMinutes(Carbon::createFromFormat('Y-m-d H:i:s', $game->start_time))}} min
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
@vite(['resources/js/index.js'])
@endsection
