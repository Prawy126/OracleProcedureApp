create or replace trigger jobs_id_trg
            before insert on JOBS
            for each row
                begin
            if :new.ID is null then
                select jobs_id_seq.nextval into :new.ID from dual;
            end if;
            end;