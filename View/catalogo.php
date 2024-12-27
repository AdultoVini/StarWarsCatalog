<div>
    {% for l in Logs %}
        {{l.LOG_ID}}
        {{l.LOG_Solicitacao}}
        {{l.LOG_Metodo}}
    {% endfor %}
</div>