@extends('backend.layouts.app')

@section('content')

    <div class="container">

        @if(session()->has('status'))
            <div class="alert alert-info">
                <span>{{ session()->get('status') }}</span>
            </div>
        @endif
          <form action="{{ route('setting.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Url callback для TelegramBot</label>
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Действие
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item"  href="#" onclick="document.getElementById('url_callback_bot').value = '{{ url(' ')}}">Вставить url</a></li>
                            <li><a class="dropdown-item"  href="#" onclick="event.preventDefault(); document.getElementById('setWebHook').submit();">Отправить url</a></li>
                            <li><a class="dropdown-item"  href="#" onclick="event.preventDefault(); document.getElementById('getWebHookInfo').submit();">Получить информацию </a></li>
                        </ul>
                    </div>
                    <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" value="{{ $url_callback_bot ?? ''}}">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Сохранить   </button>
        </form>

            <form action="{{ route('setting.setWebhook') }}" id="setWebHook" method="post" style="display: none">
                @csrf
                <input type="hidden" name="url" value="{{ $url_callback_bot ?? '' }}">
            </form>
            <form action="{{ route('setting.getWebhookInfo') }}" id="getWebHookInfo" method="post" style="display: none">
                @csrf
            </form>
    </div>
@endsection
