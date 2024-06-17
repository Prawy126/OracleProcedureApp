create or replace trigger users_id_trg
            before insert on USERS
            for each row
                begin
            if :new.ID is null then
                select users_id_seq.nextval into :new.ID from dual;
            end if;
            end;