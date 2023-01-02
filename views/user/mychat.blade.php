@extends('front.layout.master')
@section('title','My Chats | ')
@section('body')

<style>


</style>
<div class="container-fluid">

    <div class="row">
      <div class="col-xl-3 col-lg-12 col-sm-12">
        @include('user.sidebar')
      </div>
  
  
      <div class="col-xl-9 col-lg-12 col-sm-12">
  
        <div class="bg-white2">
          <h5 class="user_m2">My Chats ({{$conversations->count()}}) </h5>
          <hr>
          <div class="row">
          <div class="col-md-8">  
            @forelse($conversations as $chat)
              <div class="shadow-sm card">
                  <div class="card-body">
                      
                      <div class="row">
                          <div class="col-md-4">
                              <p class="font-weight-bold">{{ __("Conversation ID") }}</p>
                              <a href="{{ route('user.chat.view',$chat->conv_id) }}">{{ $chat->conv_id }}</a>
                          </div>

                          <div class="col-md-4">
                              <p class="font-weight-bold">{{ __("Conversation with") }}</p>
                              <span>{{ $chat->sender->name }}</span>
                          </div>

                          <div class="col-md-4">
                              <p class="font-weight-bold">{{ __("Last Message") }}</p>
                              <span> <b><?php if(isset($chat->chat->last()->message)){ echo $chat->chat->last()->message; } ?> </b> {{ __('from') }} <?php  if(isset($chat->chat->last()->user->name)){ echo $chat->chat->last()->user->name; } ?> -  <?php if(isset($chat->chat->last()->created_at)){ echo $chat->chat->last()->created_at->format('jS M Y - h:i A'); } ?>  </span>
                          </div>
                      </div>
                      
                  </div>
              </div>
            @empty
            @endforelse
          </div>
          <div class="col-md-4">
            <div class="chat-list">
                        <div class="chat-search">
                            <form>
                                <div class="input-group">
                                  <input type="search" name="user" class="form-control" placeholder="{{ __('Search') }}" aria-label="Search" aria-describedby="button-addon3">
                                  <div class="input-group-append">
                                    <button class="btn" type="submit" id="button-addon3"><i class="feather fa fa-search"></i></button>
                                  </div>
                                </div>
                            </form>
                        </div>
                        <div style="max-height: 300px;overflow:auto;" class="chat-user-list">
                            <ul class="list-unstyled mb-0">
                                
                                @foreach($users as $user)
                                    <a href="{{ route('adminchat.start',$user->id) }}">
                                      <li class="media">
                                        @if($user->image != '' && file_exists(public_path().'/images/user/'.$user->image))
                                            <img class="align-self-center rounded-circle" src="{{ url('images/user/'.$user->image) }}"/>
                                        @else 
                                            <img class="align-self-center rounded-circle" src="{{ Avatar::create($user->name)->toBase64() }}"/>
                                        @endif
                                        <div class="media-body">
                                            <h5>{{ $user->name }}</h5>
                                            <p>Admin</p>
                                        </div>
                                    </li>
                                    </a>
                                @endforeach
                                
                            </ul>
                            
                        </div>
                        {!! $users->links() !!}
            </div>
          </div>

          </div>

        </div>
      </div>
  
  
    </div>
  
  </div>
@endsection