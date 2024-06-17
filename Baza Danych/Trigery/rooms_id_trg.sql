create or replace trigger rooms_id_trg
            before insert on ROOMS
            for each row
                begin
            if :new.ID is null then
                select rooms_id_seq.nextval into :new.ID from dual;
            end if;
            end;