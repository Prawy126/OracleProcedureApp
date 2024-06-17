create or replace PACKAGE szpital AS
    TYPE medicin_rec IS RECORD (
        id NUMBER,
        name VARCHAR2(200),
        instruction CLOB,
        warehouse_quantity NUMBER,
        drug_category VARCHAR2(200),
        drug_form VARCHAR2(200),
        price NUMBER,
        dose_unit VARCHAR2(200)
    );

    TYPE room_rec IS RECORD (
        id NUMBER,
        rnumber VARCHAR2(200),
        rlocation VARCHAR2(200),
        status VARCHAR2(200),
        type_room VARCHAR2(200),
        seats NUMBER
    );

    TYPE treatment_type_rec IS RECORD (
        id NUMBER,
        name VARCHAR2(200),
        description CLOB,
        recommendations_before_surgery CLOB,
        recommendations_after_surgery CLOB,
        created_at TIMESTAMP,
        updated_at TIMESTAMP
    );

    PROCEDURE add_medicin(
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    );

    PROCEDURE get_medicin(
        p_medicin_id IN NUMBER,
        p_medicin OUT SYS_REFCURSOR
    );

    PROCEDURE update_medicin(
        p_medicin_id IN NUMBER,
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    );

    PROCEDURE delete_medicin(
        p_medicin_id IN NUMBER
    );

    PROCEDURE add_room(
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN INTEGER
    );

    PROCEDURE get_room(
        p_room_id IN NUMBER,
        p_room OUT SYS_REFCURSOR
    );

    PROCEDURE update_room(
        p_room_id IN NUMBER,
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN NUMBER
    );

    PROCEDURE delete_room(
        p_room_id IN NUMBER
    );

    PROCEDURE add_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_CREATED_AT IN TIMESTAMP
    );

    PROCEDURE get_treatment_type(
        p_ID IN NUMBER,
        p_NAME OUT VARCHAR2,
        p_DESCRIPTION OUT CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY OUT CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY OUT CLOB,
        p_CREATED_AT OUT TIMESTAMP,
        p_UPDATED_AT OUT TIMESTAMP
    );

    PROCEDURE update_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_UPDATED_AT IN TIMESTAMP
    );

    PROCEDURE delete_treatment_type(
        p_ID IN NUMBER
    );
END szpital;

create or replace PACKAGE BODY szpital AS

    PROCEDURE add_medicin(
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    ) IS
    BEGIN
        INSERT INTO MEDICINS (ID,NAME, INSTRUCTION, WAREHOUSE_QUANTITY, DRUG_CATEGORY, PRICE, DOSE_UNIT, DRUG_FORM)
        VALUES (MEDICINS_ID_SEQ.NEXTVAL,p_name, p_instruction, p_warehouse_quantity, p_drug_category, p_price, p_dose_unit, p_drug_form);
    END add_medicin;

    PROCEDURE get_medicin(
        p_medicin_id IN NUMBER,
        p_medicin OUT SYS_REFCURSOR
    ) IS
    BEGIN
        OPEN p_medicin FOR
        SELECT * FROM medicins WHERE id = p_medicin_id;
    END get_medicin;

    PROCEDURE update_medicin(
        p_medicin_id IN NUMBER,
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    ) IS
    BEGIN
        UPDATE medicins
        SET name = p_name,
            instruction = p_instruction,
            warehouse_quantity = p_warehouse_quantity,
            drug_category = p_drug_category,
            drug_form = p_drug_form,
            price = p_price,
            dose_unit = p_dose_unit
        WHERE id = p_medicin_id;
    END update_medicin;

    PROCEDURE delete_medicin(
        p_medicin_id IN NUMBER
    ) IS
    BEGIN
        DELETE FROM medicins WHERE id = p_medicin_id;
    END delete_medicin;

    PROCEDURE add_room(
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN INTEGER
    ) IS
    BEGIN
        INSERT INTO rooms (rnumber, rlocation, status, type_room, seats)
        VALUES (p_rnumber, p_rlocation, p_status, p_type_room, p_seats);
    END add_room;

    PROCEDURE get_room(
        p_room_id IN NUMBER,
        p_room OUT SYS_REFCURSOR
    ) IS
    BEGIN
        OPEN p_room FOR
        SELECT * FROM rooms WHERE id = p_room_id;
    END get_room;

    PROCEDURE update_room(
        p_room_id IN NUMBER,
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN NUMBER
    ) IS
    BEGIN
        UPDATE rooms
        SET rnumber = p_rnumber,
            rlocation = p_rlocation,
            status = p_status,
            type_room = p_type_room,
            seats = p_seats
        WHERE id = p_room_id;
    END update_room;

    PROCEDURE delete_room(
        p_room_id IN NUMBER
    ) IS
    BEGIN
        DELETE FROM rooms WHERE id = p_room_id;
    END delete_room;

    PROCEDURE add_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_CREATED_AT IN TIMESTAMP
    ) IS
    BEGIN
        INSERT INTO TREATMENT_TYPES ("ID", "NAME", "DESCRIPTION", RECOMMENDATIONS_BEFORE_SURGERY, RECOMMENDATIONS_AFTER_SURGERY, CREATED_AT)
        VALUES (p_ID, p_NAME, p_DESCRIPTION, p_RECOMMENDATIONS_BEFORE_SURGERY, p_RECOMMENDATIONS_AFTER_SURGERY, p_CREATED_AT);
    END add_treatment_type;

    PROCEDURE get_treatment_type(
        p_ID IN NUMBER,
        p_NAME OUT VARCHAR2,
        p_DESCRIPTION OUT CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY OUT CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY OUT CLOB,
        p_CREATED_AT OUT TIMESTAMP,
        p_UPDATED_AT OUT TIMESTAMP
    ) IS
    BEGIN
        SELECT NAME, DESCRIPTION, RECOMMENDATIONS_BEFORE_SURGERY, RECOMMENDATIONS_AFTER_SURGERY, CREATED_AT, UPDATED_AT
        INTO p_NAME, p_DESCRIPTION, p_RECOMMENDATIONS_BEFORE_SURGERY, p_RECOMMENDATIONS_AFTER_SURGERY, p_CREATED_AT, p_UPDATED_AT
        FROM TREATMENT_TYPES
        WHERE ID = p_ID;
    END get_treatment_type;

    PROCEDURE update_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_UPDATED_AT IN TIMESTAMP
    ) IS
    BEGIN
        UPDATE TREATMENT_TYPES
        SET NAME = p_NAME, DESCRIPTION = p_DESCRIPTION, RECOMMENDATIONS_BEFORE_SURGERY = p_RECOMMENDATIONS_BEFORE_SURGERY,
            RECOMMENDATIONS_AFTER_SURGERY = p_RECOMMENDATIONS_AFTER_SURGERY, UPDATED_AT = p_UPDATED_AT
        WHERE ID = p_ID;
    END update_treatment_type;

    PROCEDURE delete_treatment_type(
        p_ID IN NUMBER
    ) IS
    BEGIN
        DELETE FROM TREATMENT_TYPES WHERE ID = p_ID;
    END delete_treatment_type;

END szpital;
