@extends( 
        ($theme =="white") ? 'tenant.layouts.public_white':
     ( ($theme =="red") ? 'tenant.layouts.public_red':
    (($theme =="green") ? 'tenant.layouts.public_green':
    (($theme =="black") ? 'tenant.layouts.public_black':
    (($theme =="blue") ?'tenant.layouts.public_blue':'tenant.layouts.public_yellow' ))))
    )

@section('content')

<div class="section-header col-12 col-md-10 offset-md-1">
    <h1>{{ __('Knowledge Base') }}</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card article_card">
                <!-- <div class="card-header">
                    <h4>{{ __('Knowledge Base categories') }}</h4>
                </div> -->
                <div class="card">
                    @if (!count($categories))
                    <div class="empty-state pt-3" data-height="400">
                        <div class="empty-state-icon bg-custom">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2>{{ __('No data found') }} !!</h2>
                        <p class="lead">
                            {{ __('Sorry we cant find any data') }}.
                        </p>
                    </div>
                    @else

                    <div class="row ml-md-5">
                        @foreach($categories as $category)
                        @if (count($category_article[$category->uuid]))
                        <div class="col-12 col-md-6 col-lg-6 wizard-steps">
                            <div class="card-body">
                             
                                    <div class="wizard-step">
                                        <a href="{{ route('articles.show', [$category->uuid]) }}">
                                        <div class="wizard-step-label category custom_category ">
                                            {{ __($category->category_text) }}
                                        </div>
                                                 </a>
                                     
                                       
                                        <div class="card-body">
                                              @if (!count($category_article[$category->uuid]))
                                                <div class="empty-state pt-3" data-height="400">
                                                    <div class="empty-state-icon bg-custom">
                                                        <i class="fas fa-question"></i>
                                                    </div>
                                                    <h2>{{ __('No data found') }} !!</h2>
                                                    <p class="lead">
                                                        {{ __('Sorry we cant find any data') }}.
                                                    </p>
                                                </div>
                                            @else
                                      
                                        @foreach($category_article[$category->uuid] as $article)      
                                        <a class="nav-link kb-custom_article"
                                            href="{{ route('showArticle', [$article->slug]) }}">
                                            <div class=" ">
                                            {{ __($article->title) }}
                                            </div>
                                        </a>
                                        @endforeach
                                         @endif
                                    
                                        </div>

                                    </div>
                       
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

            
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection
