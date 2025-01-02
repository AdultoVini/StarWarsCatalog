{% for m in movies %}
    <div class="col-md-4 d-flex justify-content-center">
        <a href="/StarWarsCatalogo/filmes?id={{m.uid}}">
            <div class="container-cartaz">
                <img src="./Style/images/cartazfilmes.jpg" class="cartaz"/>
                <p class="title-cartaz">
                    <span class="title-cartaz mb-3">
                        <span>Star Wars</span>
                        <span>{{m.properties.title}}</span>
                    </span>
                    <span>{{m.properties.release_date|date('d/m/Y')}}</span>
                </p>
            </div>
        </a>
    </div>
{% endfor %}
