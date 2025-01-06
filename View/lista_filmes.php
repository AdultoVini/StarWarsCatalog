<div class="row d-flex w-fit">
{% for m in movies %}
    <a class="links-filmes" href="/StarWarsCatalogo/filmes?id={{m.uid}}">
        <div class="container-cartaz">
            <img src="./Style/images/{{m.uid}}.jpg" class="cartaz"/>
            <p class="title-cartaz">
                <span class="title-cartaz mb-3">
                    <span>Star Wars</span>
                    <span>{{m.properties.title}}</span>
                </span>
                <span>{{m.properties.release_date|date('d/m/Y')}}</span>
            </p>
        </div>
    </a>
    {% endfor %}
</div>
