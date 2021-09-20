<div class="list-group">
    <a href="{{ route('app.setting.general.index') }}" class="list-group-item list-group-item-action {{ Route::is('app.setting.general.index') ? 'active' : '' }}"> General</a>

    <a href="{{ route('app.setting.appearance.index') }}" class="list-group-item list-group-item-action {{ Route::is('app.setting.appearance.index') ? 'active' : '' }}"> Appearance</a>

    {{-- <a href="{{ route('backend.setting.mail') }}" class="list-group-item list-group-item-action {{ Route::is('backend.setting.mail') ? 'active' : '' }}"> Mail</a>

    <a href="{{ route('backend.setting.socialite') }}" class="list-group-item list-group-item-action {{ Route::is('backend.setting.socialite') ? 'active' : '' }}"> Socialite</a> --}}
</div>