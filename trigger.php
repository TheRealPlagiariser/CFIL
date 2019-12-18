<?php


CREATE TRIGGER mirrorProject
AFTER INSERT
ON il_Test.project
FOR EACH ROW

    INSERT INTO cf_Test.project
    SET action='Insert',
      projectCode= 'name',
      projectName=NEW.projectName,
      createdBy=NEW.createdBy,
      dateCreated=NEW.dateCreated,
      deleted=NEW.deleted









?>
