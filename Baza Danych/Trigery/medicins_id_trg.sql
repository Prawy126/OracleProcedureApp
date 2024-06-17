create or replace trigger medicins_id_trg
            before insert on MEDICINS
            for each row
                begin
            if :new.ID is null then
                select medicins_id_seq.nextval into :new.ID from dual;
            end if;
            end;