{{ form("session/start") }}
<fieldset>
    <div>
        <label for="email">
            Username/Email
        </label>

        <div>
            {{ text_field("email") }}
        </div>
    </div>

    <div>
        <label for="password">
            Password
        </label>

        <div>
            {{ password_field("password") }}
        </div>
    </div>



    <div>
        {{ submit_button("Login") }}
    </div>
</fieldset>
{{ endForm() }}