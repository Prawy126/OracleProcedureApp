create or replace PROCEDURE ADD_ROOM (
       p_rnumber IN VARCHAR2,
       p_rlocation IN VARCHAR2,
       p_status IN VARCHAR2,
       p_type_room IN VARCHAR2,
       p_seats IN INTEGER
   ) AS
   BEGIN
       INSERT INTO rooms (rnumber, rlocation, status, type_room, seats)
       VALUES (p_rnumber, p_rlocation, p_status, p_type_room, p_seats);
   END;

create or replace PROCEDURE DELETE_ROOM(
    p_room_id IN NUMBER)
IS
BEGIN
    DELETE FROM rooms WHERE id = p_room_id;
END;

create or replace PROCEDURE GET_ROOM(
    p_room_id IN NUMBER,
    p_room OUT SYS_REFCURSOR)
IS
BEGIN
    OPEN p_room FOR
    SELECT * FROM rooms WHERE id = p_room_id;
END;

create or replace PROCEDURE UPDATE_ROOM(
    p_room_id IN NUMBER,
    p_rnumber IN VARCHAR2,
    p_rlocation IN VARCHAR2,
    p_status IN VARCHAR2,
    p_type_room IN VARCHAR2,
    p_seats IN NUMBER)
IS
BEGIN
    UPDATE rooms
    SET rnumber = p_rnumber,
        rlocation = p_rlocation,
        status = p_status,
        type_room = p_type_room,
        seats = p_seats
    WHERE id = p_room_id;
END;