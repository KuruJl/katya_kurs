@extends('admin.layout')

@section('content')
<div class="card">
    <h1>Все бронирования</h1>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid #ddd;">
                <th style="padding: 10px; text-align: left;">ID</th>
                <th style="padding: 10px; text-align: left;">Клиент</th>
                <th style="padding: 10px; text-align: left;">Дата</th>
                <th style="padding: 10px; text-align: left;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px;">{{ $booking->id }}</td>
                <td style="padding: 10px;">{{ $booking->user->name }}</td>
                <td style="padding: 10px;">{{ $booking->start_time->format('d.m.Y H:i') }}</td>
                <td style="padding: 10px;">
                    <a href="{{ route('admin.bookings.edit', $booking) }}" 
                       style="color: #a73151; text-decoration: none;">Редактировать</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $bookings->links() }}
</div>
@endsection