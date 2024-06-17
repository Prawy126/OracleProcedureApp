create or replace trigger nurses_id_trg
            before insert on NURSES
            for each row
                begin
            if :new.ID is null then
                select nurses_id_seq.nextval into :new.ID from dual;
            end if;
            end;