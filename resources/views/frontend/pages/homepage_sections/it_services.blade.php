<div class="service_area">
    @foreach ($it_services as $service)    
        <div class="service wordpress">
            <div class="service_logo">
                <img src="{{ asset($service->image) }}"
                    alt="service techpark it">
            </div>
            <div class="service_title_and_description">
                <div class="title">
                    <p class="title_text">
                        {{ $service->title }}
                    </p>
                </div>
                <div class="description">
                    <p class="description_text">
                        {{ $service->description }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>