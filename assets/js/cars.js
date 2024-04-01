getCars = () => {
    $.get("cars.json", (data) => {
        let output = '';
        data.forEach((car) => {
            output +=  `
                <div class="col-md-4">
                    <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end" style="background-image: url(theme/images/${car.image});">
                        </div>
                        <div class="text">
                            <h2 class="mb-0"><a href="#c-class">${car.name}</a></h2>
                            <div class="d-flex mb-3">
                                <span class="cat">${car.manufacturer}</span>
                                <p class="price ml-auto">${car.price}/day<span></span></p>
                            </div>
                            <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="#c-class" class="btn btn-secondary py-2 ml-1">Details</a></p>
                        </div>
                    </div>
                </div>
            `;
        });

        $(".row").append(output);
    });
}

getCars();
