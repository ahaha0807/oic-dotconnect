{{--  マイページのプロフィール部分 --}}
<div class="col item-box my-prof">
  <h2>プロフィール</h2>
  <div class="icon-display">
    <img src={{ Auth::user()->image_pass }} alt="">
  </div>
  <div class="user-name">
    <div class="name">
      <p class="input-info">{{ Auth::user()->name }}</p>
    </div>
    <div class="code">
      <p class="input-info">{{ Auth::user()->code }}</p>
    </div>
    <div class="introduction">
      {{ Auth::user()->introduction }}
    </div>
    <div class="account-move">
      {!! link_to_route('user-setting-profile', 'アカウント設定ページへ', [], [ "class" => "account-move-button"]) !!}
    </div>
  </div>
</div>