create or replace trigger failed_jobs_id_trg
            before insert on FAILED_JOBS
            for each row
                begin
            if :new.ID is null then
                select failed_jobs_id_seq.nextval into :new.ID from dual;
            end if;
            end;