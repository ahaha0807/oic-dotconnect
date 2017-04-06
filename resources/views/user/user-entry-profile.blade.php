@extends('layout.app')

@section('head')
	<link rel="stylesheet" href="{{{secure_asset('css/user-entry/user-entry-common.css')}}}" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="{{{secure_asset('css/user-entry/user-entry-profile.css')}}}" media="screen" title="no title" charset="utf-8">
@endsection

@section('content')
  <div class="wrapper">
    @include('components.user-entry-step', [ 'current' => 'profile' ])
    <h1 class="user-entry-title">プロフィール登録</h1>
    {{ Form::open([
      'route' => 'post-user-entry-profile',
      'class' => 'row register-form',
      'files' => true
    ])}}
      <div class="col">

        <div class="row" style="margin-bottom:20px">
          <div class="col icon-col box input-form">        
            <h2 class="box-title red">アイコン</h2>        
            <div class="box-content">
              @if($icon === "")
                <img-show old-image=""></img-show>  
              @else
                <img-show old-image={{explode('public',$icon)[1]}}></img-show>
              @endif
              <input type="hidden" name="old_icon" value={{$icon}}> 
            </div>        
          </div>
          <div class="col name-col">
            <div class="user-name box input-form required">          
              <h2 class="box-title yellow">ニックネーム</h2>          
              <div class="name-input">
                <input type="text" class="border form-input" name="name" value="{{$name}}">
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->get('name') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
              </div>
            </div>
            <div class="user-code box input-form required">          
              <h2 class="box-title green">ユーザコード</h2>        
              <div class="code-input">
                <input type="text" class="border form-input " name="code" value={{$code}}>
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->get('code') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                <div class="caution">
                    <p class="caution-mark">※ユーザーコードは登録後変更できません</p>                    
                    <p class="caution-mark">※使用できる文字は英数字(-)(_)のみです。</p>
                    <p class="caution-mark">※20文字以内</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="introduction box">    
          <h2 class="box-title blue">紹介文</h2>    
          <div class="introduction-input">
            <textarea class="border" rows="10" cols="60" name="introduction">{{$introduction}}</textarea>
            <div class="caution">
              <p class="caution-mark">※200文字以内</p>
            </div>
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->get('introduction') as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
          </div>
        </div>

        <div class="row info">
          <div class="col">
            <div class="fav">
              <button type="submit" name="submit" value="toTag" class="fav-register button">お気に入りタグ登録へ</button>
              <p class="caution-mark">※お気に入りタグは登録後、ユーザー設定から登録・変更できます。</p>
            </div>
            <div class="row">
              <div class="info-left">
                <a href="{{ route('user-entry-cancel') }}" class="button cancell left">キャンセル</a>
              </div>
              <div class="info-right">
                <button type="submit" name="submit" value="toConfirm" class="conf button right">入力確認へ</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- <form class="col register-form">-->
    {{ Form::close() }}
  </div>
@endsection