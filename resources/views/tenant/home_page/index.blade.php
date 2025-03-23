@extends( 
        ($theme =="white") ? 'tenant.layouts.public_white':
     ( ($theme =="red") ? 'tenant.layouts.public_red':
    (($theme =="green") ? 'tenant.layouts.public_green':
    (($theme =="black") ? 'tenant.layouts.public_black':
    (($theme =="blue") ?'tenant.layouts.public_blue':'tenant.layouts.public_yellow' ))))
    )

@section('content')
<div class="s004">
    <form class="home_form" method="POST" action="/">
        @csrf
        <div class="form-group">
            <fieldset>
                <legend>What are you looking for?</legend>
                <div class="inner-form">
                    <div class="input-field">
                        <div class="choices" data-type="text" aria-haspopup="true" aria-expanded="false" dir="ltr">
                            <div class="choices__inner">
                                <input id="article" type="text" placeholder="What are you looking for?"
                                    class="form-control choices__input is-hidden on-focus:border-0" name="article"
                                    value="{{ old('article') }}" autocomplete="article" autofocus>
                            </div>
                            <div class="choices__list choices__list--dropdown" aria-expanded="false">
                            </div>
                        </div>
                        <button class="btn-search" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#fff"
                                viewBox="0 0 24 24">
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </fieldset>
            @if (count($articles) && $isArticles === 1)
                <h4 class="search_results_title mb-4 text-center ">{{ count($articles) }} Search Results Found</h4>
                <div class ="mb-5">
                @foreach ($articles as $article)
                    <div class="row">
                        <div class="col-12 col-md-10   mt-2 ">
                            <div class=" mb-n4">
                                <div class="p-0 ">
                                    <h4 class="mt-3 text-capitalize"><a class="nav-link p-0 "
                                            href="{{ route('showArticle', [$article->slug]) }}">
                                            {{ __($article->title) }} </a></h4>

                                </div>
                                <div class=" px-2 ">
                                    <p class=" text-capitalize">{!! Str::limit(strip_tags($article->description), 100) !!}</p>
                                    <p> <span> <i class=" fa fa-regular fa-calendar mb-2"></i></span><span>
                                            {{ $article->created_at->format('d-M-Y H:i') }}</span> </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    
                @endforeach
                </div>
            @elseif($isArticles === 0)
                <div class="empty-state pt-3" data-height="150">
                    <div class="empty-state-icon bg-danger">
                        <i class="fas fa-question"></i>
                    </div>
                    <h4 class="search_results_title mb-4 text-center p-2">{{ _('Search Result Not  Found') }}</h4>
                    <p class="lead">
                        {{ __('Sorry we cant find any data') }}.
                    </p>
                </div>
            @endif

            <!-- Section_1 -->
            <section>
                <div class="container">
                    <div class="row flex-nowrap">
                        <!-- Card_1 -->
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-3  d-flex justify-content-center align-items-center">

                                    <i style="font-size:50px;color:#D3D3D3" class="fa fa-database  -mt-2" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title "><a class="home-article text-primary"
                                                href="{{ route('articles.index') }}">{{ __('Knowledge Base') }}</a></h5>
                                        <p class="card-text">See all the knowldge base categories and articles under the KB
                                            categories from the
                                            Knowledgebase ssection of the Ticketing System.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Card_2 -->
                        <div class="card mb-3" style="min-width:400px; ">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center align-items-center">

                                    <i style="font-size:50px;color:#D3D3D3" class="fas fa-question-circle mt-4 -mt-2"></i>
                                </div>
                                <div class="col-md-8" style="min-height:130px;">
                                    <div class="card-body">
                                        <h5 class="card-title "><a class="home-article text-primary"
                                                href="{{ route('faq_list.index') }}">{{ __('FAQs') }}</a></h5>
                                        <p class="card-text">You can see all of the FAQs from the FAQs section of the ticketing
                                            system.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                    <div class="row flex-nowrap">
                        <!-- Card_2 -->
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-3 d-flex justify-content-center align-items-center">
                                    <i style="font-size:50px;color:#D3D3D3" class=" fas fa-solid fa-bullhorn  "></i>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a class="home-article text-primary"
                                                href="{{ route('user_announcements') }}">{{ __('Announcements') }}</a></h5>
                                        <p class="card-text">You can view all of our announcements and news from this section.
                                            Please click the above link to
                                            view them.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Card_1 -->
                        @if (Auth::check() && Auth::user()->role == 'user')
                            <div class="card mb-3" style="min-width:400px;">
                                <div class="row g-0">
                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                        <i style="font-size:50px;color:#D3D3D3" class="fas fa-ticket-alt -mt-2"></i>
                                    </div>
                                    <div class="col-md-8" style="min-height:140px;">
                                        <div class="card-body">

                                            <h5 class="card-title"><a class="home-article text-primary"
                                                    href="{{ route('get_tickets') }}"> {{ __('Tickets') }}</a></h5>
                                            <p class="card-text">You can view all of your tickets by clicking the above link.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->
                        @else
                            <div class="card mb-3" style="max-width: 400px;">
                                <div class="row g-0">
                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                        <i style="font-size:50px;color:#D3D3D3" class="fa fa-user-circle mr-1 -mt-2"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><a class="home-article text-primary"
                                                    href="{{ route('login') }}"> {{ __('Login') }}</a></h5>
                                            <p class="card-text">You can login to the ticketing system by clicking the above login
                                                link.
                                                If you are not registered with us, please register by <a
                                                    href="{{ route('register') }}">clicking here.</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->
                        @endif
                    </div>
                </div>
            </section>
            <!-- Section_1 End -->
        </div>
    </form>
</div>
@endsection