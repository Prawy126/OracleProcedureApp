create or replace trigger statuses_id_trg
            before insert on STATUSES
            for each row
                begin
            if :new.ID is null then
                select statuses_id_seq.nextval into :new.ID from dual;
            end if;
            end;