@php
 $states=\App\Models\State::get();
 //$state_0=State::skip(0)->first();
 $property[0]=\App\Models\Property::where('state',$states[0]->id)->get();
 $property[1]=\App\Models\Property::where('state',$states[1]->id)->get();
 $property[2]=\App\Models\Property::where('state',$states[2]->id)->get();
 $property[3]=\App\Models\Property::where('state',$states[3]->id)->get();
@endphp



<section class="place-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Top Places</h5>
            <h2>Most Popular Places</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
        </div>
        <div class="sortable-masonry">
            <div class="items-container row clearfix">



                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{asset(asset($states[0]->state_image))}}" alt="" style="width: 370px;height: 580px"></figure>
                            <div class="text">
                                <h4><a href="{{route('state.details',$states[0]->id)}}">{{$states[0]->state_name}}</a></h4>
                                <p>{{count($property[0])}} Properties</p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all brand illustration print software logo">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{asset(asset($states[1]->state_image))}}" alt="" style="width: 370px;height: 275px"></figure>
                            <div class="text">
                                <h4><a href="{{route('state.details',$states[1]->id)}}">{{$states[1]->state_name}}</a></h4>
                                <p>{{count($property[1])}} Properties</p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration marketing logo">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{asset(asset($states[2]->state_image))}}" alt="" style="width: 370px;height: 275px" alt=""></figure>
                            <div class="text">
                                <h4><a href="{{route('state.details',$states[2]->id)}}">{{$states[2]->state_name}}</a></h4>
                                <p>{{count($property[2])}} Properties</p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-8 col-md-6 col-sm-12 masonry-item small-column all brand marketing print software">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{asset(asset($states[3]->state_image))}}" alt="" style="width: 770px;height: 275px" alt=""></figure>
                            <div class="text">
                                <h4><a href="{{route('state.details',$states[3]->id)}}">{{$states[3]->state_name}}</a></h4>
                                <p>{{count($property[3])}} Properties</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

