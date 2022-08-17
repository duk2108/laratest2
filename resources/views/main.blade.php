<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Test</title>
    <link rel="stylesheet" href="./main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>
        function expStart() {
            expChange(10);
            $.ajax({
                url: "{{ route('user.showexp') }}",
                success: function (data) {
                   $('#expout').html(data);
                }
            });
        }
        function authorStart() {
            $.ajax({
                url: "{{ route('user.form') }}" + '/authortest/' + $('#authorid').val(),
                success: function (data) {
                    $('#expout').html(data);
                }
            });
        }
        function expChange(lim) {
            if (lim==0){
                return false
            }
            $.ajax({
                url: "{{ route('user.changeexp') }}",
                success: function (data) {
                    expChange(lim-1);
                }
            });
        }
    </script>
</head>
<body>
<div>
    <input type="button" onclick="expStart();" value="Test Exp"><br><br>
    <input type="text" value="1" id="authorid"><input type="button" onclick="authorStart();" value="Test Author"><br>
    <div id="expout"></div>
</div>
<div class="wrapper">
    <main class="main-content">
        <div class="my-profile">
            <h2 class="heading">{{  __('site.myprofile') }}</h2>
            <div class="profile">
                <div class="avatar">
                    @if ($mode == 'aterAdd')
                        <!--<img src="{{ route('user.form') }}/avatar/{{ $added['id'] }}" alt="{{  __('site.avatar') }}" class="avatar__pic">-->
                            <img src="{{ route('user.avatar', $added['id']) }}" alt="{{  __('site.avatar') }}" class="avatar__pic">
                    @else
                        <img src="./image.jpg" alt="{{  __('site.avatar') }}" class="avatar__pic">
                    @endif
                </div>
                <div class="information">
                    <div class="nickname">@if ($mode == 'aterAdd') {{ $added['nickname'] }} @else {{  __('site.nickname') }} @endif</div>
                    <div class="user-name">
                        <span class="name">@if ($mode == 'aterAdd') {{ $added['name'] }} @else {{  __('site.name') }} @endif</span>
                        <span class="surname">@if ($mode == 'aterAdd') {{ $added['surname'] }} @else {{  __('site.surname') }} @endif</span>
                    </div>
                    <a href='tel:@if ($mode == 'aterAdd') {{ $added['phone'] }} @else +1111111111 @endif' class="phone">@if ($mode == 'aterAdd') {{ $added['phone'] }} @else +1 111 11-11-11 @endif</a>
                </div>
            </div>
        </div>
        <div class='edit-profile'>
            <h2 class="heading">{{  __('site.editprofile') }}</h2>
            <form class='form' id='form' method='POST' enctype='multipart/form-data'>
                @csrf
                <ul class="form__list">
                    <li class="form__item">
                        <label class='form__label' for="nickname">{{  __('site.nickname') }}:</label>
                        <input class='form__input' name='nickname' id='nickname' type="text" value="{{ $added['nickname'] }}" @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    <li class="form__item">
                        <label class='form__label' for="name">{{  __('site.name') }}:</label>
                        <input class='form__input' name='name' id='name' type="text" value="{{ $added['name'] }}" @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    <li class="form__item">
                        <label class='form__label' for="surname">{{  __('site.surname') }}:</label>
                        <input class='form__input' name='surname' id='surname' type="text" value="{{ $added['surname'] }}" @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    <li class="form__item">
                        <label class='form__inline-label' for="avatar">{{  __('site.avatar') }}:</label>
                        <input class='form__inline-input' id='avatar' name='avatar' type="file" value='image/jpeg,image/png' @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    <li class="form__item">
                        <label class='form__label' for="phone">{{  __('site.phone') }}:</label>
                        <input class='form__input' name='phone' id='phone' type="text" value="{{ $added['phone'] }}" @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    <li class="form__item">
                        <div class="form__title">{{  __('site.sex') }}:</div>
                        <label class='form__inline-label' for="male">{{  __('site.male') }}</label>
                        <input class='form__inline-input' name='sex' id='male' type="radio" value="0" @if (!$added['surname'] == 1) checked @endif  @if ($mode == 'aterAdd')disabled @endif >
                        <label class='form__inline-label' for="female">{{  __('site.female') }}</label>
                        <input class='form__inline-input' name='sex' id='female' type="radio" value="1" @if ($added['sex'] == 1) checked @endif  @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    <li class="form__item">
                        <label class='form__inline-label' for="showPhone">{{  __('site.subscribe') }}</label>
                        <input class='form__inline-input' name='showphone' id='showPhone' type="checkbox" @if ($added['showphone'] == 1) checked @endif  @if ($mode == 'aterAdd')disabled @endif >
                    </li>
                    @if ($mode == 'beforeAdd')
                    <li class="form__item">
                        <button class='form__button' type="submit">{{  __('site.send') }}</button>
                    </li>
                    @endif
                </ul>
            </form>
        </div>
    </main>
</div>
</body>
</html>
