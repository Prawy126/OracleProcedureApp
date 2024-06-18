create or replace FUNCTION CHECK_PASSWORD(p_username IN VARCHAR2, p_password IN VARCHAR2) RETURN BOOLEAN IS
    l_hashed_password VARCHAR2(200);
    l_stored_password VARCHAR2(200);
BEGIN
    -- Hashujemy podane hasło
    l_hashed_password := HASH_PASSWORD(p_password);

    -- Pobieramy zapisane hasło z bazy
    SELECT PASSWORD INTO l_stored_password
    FROM USERS
    WHERE LOGIN = p_username;

    -- Sprawdzamy, czy hashe są zgodne
    IF l_hashed_password = l_stored_password THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        -- Gdy użytkownik nie istnieje
        RETURN FALSE;
END;
/