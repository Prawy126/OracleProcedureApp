create or replace trigger treatments_nurses_id_trg
            before insert on TREATMENTS_NURSES
            for each row
                begin
            if :new.ID is null then
                select treatments_nurses_id_seq.nextval into :new.ID from dual;
            end if;
            end;