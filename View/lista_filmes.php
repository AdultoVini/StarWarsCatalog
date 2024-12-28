{% for m in movies %}
    <div class="col-md-4 d-flex justify-content-center">
        <div class="container-cartaz">
            <img src="./Style/images/cartazfilmes.jpg" class="cartaz"/>
            <p class="title-cartaz">
                <span>Star Wars</span>
                <span>{{m.properties.title}}</span>
                <span>{{m.properties.release_date|date('d/m/Y')}}</span>
            </p>
        </div>
    </div>
{% endfor %}
