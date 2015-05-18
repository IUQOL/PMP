/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : PostgreSQL
 Source Server Version : 90304
 Source Host           : localhost
 Source Database       : pmp_trainner
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90304
 File Encoding         : utf-8

 Date: 05/18/2015 17:44:05 PM
*/

-- ----------------------------
--  Sequence structure for answer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."answer_id_seq";
CREATE SEQUENCE "public"."answer_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."answer_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for exam_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."exam_id_seq";
CREATE SEQUENCE "public"."exam_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."exam_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for exam_question_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."exam_question_id_seq";
CREATE SEQUENCE "public"."exam_question_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."exam_question_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for exam_type_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."exam_type_id_seq";
CREATE SEQUENCE "public"."exam_type_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."exam_type_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for group_sonata_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."group_sonata_id_seq";
CREATE SEQUENCE "public"."group_sonata_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."group_sonata_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for konwledge_area_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."konwledge_area_id_seq";
CREATE SEQUENCE "public"."konwledge_area_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."konwledge_area_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for notification__message_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."notification__message_id_seq";
CREATE SEQUENCE "public"."notification__message_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."notification__message_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for proccess_group_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."proccess_group_id_seq";
CREATE SEQUENCE "public"."proccess_group_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."proccess_group_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for question_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."question_id_seq";
CREATE SEQUENCE "public"."question_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."question_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for timeline__action_component_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."timeline__action_component_id_seq";
CREATE SEQUENCE "public"."timeline__action_component_id_seq" INCREMENT 1 START 4 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."timeline__action_component_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for timeline__action_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."timeline__action_id_seq";
CREATE SEQUENCE "public"."timeline__action_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."timeline__action_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for timeline__component_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."timeline__component_id_seq";
CREATE SEQUENCE "public"."timeline__component_id_seq" INCREMENT 1 START 2 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."timeline__component_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for timeline__timeline_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."timeline__timeline_id_seq";
CREATE SEQUENCE "public"."timeline__timeline_id_seq" INCREMENT 1 START 2 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."timeline__timeline_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for user_limit_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_limit_id_seq";
CREATE SEQUENCE "public"."user_limit_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."user_limit_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Sequence structure for user_sonata_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_sonata_id_seq";
CREATE SEQUENCE "public"."user_sonata_id_seq" INCREMENT 1 START 1 MAXVALUE 9223372036854775807 MINVALUE 1 CACHE 1;
ALTER TABLE "public"."user_sonata_id_seq" OWNER TO "postgres";

-- ----------------------------
--  Table structure for notification__message
-- ----------------------------
DROP TABLE IF EXISTS "public"."notification__message";
CREATE TABLE "public"."notification__message" (
	"id" int4 NOT NULL,
	"type" varchar(255) NOT NULL COLLATE "default",
	"body" text NOT NULL COLLATE "default",
	"state" int4 NOT NULL,
	"restart_count" int4,
	"created_at" timestamp NOT NULL,
	"updated_at" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"started_at" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"completed_at" timestamp NULL DEFAULT NULL::timestamp without time zone
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."notification__message" OWNER TO "postgres";

COMMENT ON COLUMN "public"."notification__message"."body" IS '(DC2Type:json)';

-- ----------------------------
--  Table structure for group_sonata
-- ----------------------------
DROP TABLE IF EXISTS "public"."group_sonata";
CREATE TABLE "public"."group_sonata" (
	"id" int4 NOT NULL,
	"name" varchar(255) NOT NULL COLLATE "default",
	"roles" text NOT NULL COLLATE "default"
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."group_sonata" OWNER TO "postgres";

COMMENT ON COLUMN "public"."group_sonata"."roles" IS '(DC2Type:array)';

-- ----------------------------
--  Table structure for fos_user_user_group
-- ----------------------------
DROP TABLE IF EXISTS "public"."fos_user_user_group";
CREATE TABLE "public"."fos_user_user_group" (
	"user_id" int4 NOT NULL,
	"group_id" int4 NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."fos_user_user_group" OWNER TO "postgres";

-- ----------------------------
--  Table structure for exam_type
-- ----------------------------
DROP TABLE IF EXISTS "public"."exam_type";
CREATE TABLE "public"."exam_type" (
	"id" int4 NOT NULL,
	"name" varchar(150) NOT NULL COLLATE "default",
	"description" text COLLATE "default",
	"totalquestions" int4 NOT NULL,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."exam_type" OWNER TO "postgres";

-- ----------------------------
--  Table structure for timeline__action_component
-- ----------------------------
DROP TABLE IF EXISTS "public"."timeline__action_component";
CREATE TABLE "public"."timeline__action_component" (
	"id" int4 NOT NULL,
	"action_id" int4,
	"component_id" int4,
	"type" varchar(255) NOT NULL COLLATE "default",
	"text" varchar(255) DEFAULT NULL::character varying COLLATE "default"
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."timeline__action_component" OWNER TO "postgres";

-- ----------------------------
--  Table structure for timeline__action
-- ----------------------------
DROP TABLE IF EXISTS "public"."timeline__action";
CREATE TABLE "public"."timeline__action" (
	"id" int4 NOT NULL,
	"verb" varchar(255) NOT NULL COLLATE "default",
	"status_current" varchar(255) NOT NULL COLLATE "default",
	"status_wanted" varchar(255) NOT NULL COLLATE "default",
	"duplicate_key" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"duplicate_priority" int4,
	"created_at" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."timeline__action" OWNER TO "postgres";

-- ----------------------------
--  Table structure for timeline__component
-- ----------------------------
DROP TABLE IF EXISTS "public"."timeline__component";
CREATE TABLE "public"."timeline__component" (
	"id" int4 NOT NULL,
	"model" varchar(255) NOT NULL COLLATE "default",
	"identifier" text NOT NULL COLLATE "default",
	"hash" varchar(255) NOT NULL COLLATE "default"
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."timeline__component" OWNER TO "postgres";

COMMENT ON COLUMN "public"."timeline__component"."identifier" IS '(DC2Type:array)';

-- ----------------------------
--  Table structure for timeline__timeline
-- ----------------------------
DROP TABLE IF EXISTS "public"."timeline__timeline";
CREATE TABLE "public"."timeline__timeline" (
	"id" int4 NOT NULL,
	"action_id" int4,
	"subject_id" int4,
	"context" varchar(255) NOT NULL COLLATE "default",
	"type" varchar(255) NOT NULL COLLATE "default",
	"created_at" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."timeline__timeline" OWNER TO "postgres";

-- ----------------------------
--  Table structure for user_sonata
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_sonata";
CREATE TABLE "public"."user_sonata" (
	"id" int4 NOT NULL,
	"username" varchar(255) NOT NULL COLLATE "default",
	"username_canonical" varchar(255) NOT NULL COLLATE "default",
	"email" varchar(255) NOT NULL COLLATE "default",
	"email_canonical" varchar(255) NOT NULL COLLATE "default",
	"enabled" bool NOT NULL,
	"salt" varchar(255) NOT NULL COLLATE "default",
	"password" varchar(255) NOT NULL COLLATE "default",
	"last_login" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"locked" bool NOT NULL,
	"expired" bool NOT NULL,
	"expires_at" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"confirmation_token" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"password_requested_at" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"roles" text NOT NULL COLLATE "default",
	"credentials_expired" bool NOT NULL,
	"credentials_expire_at" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"created_at" timestamp NOT NULL,
	"updated_at" timestamp NOT NULL,
	"date_of_birth" timestamp NULL DEFAULT NULL::timestamp without time zone,
	"firstname" varchar(64) DEFAULT NULL::character varying COLLATE "default",
	"lastname" varchar(64) DEFAULT NULL::character varying COLLATE "default",
	"website" varchar(64) DEFAULT NULL::character varying COLLATE "default",
	"biography" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"gender" varchar(1) DEFAULT NULL::character varying COLLATE "default",
	"locale" varchar(8) DEFAULT NULL::character varying COLLATE "default",
	"timezone" varchar(64) DEFAULT NULL::character varying COLLATE "default",
	"phone" varchar(64) DEFAULT NULL::character varying COLLATE "default",
	"facebook_uid" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"facebook_name" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"facebook_data" text COLLATE "default",
	"twitter_uid" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"twitter_name" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"twitter_data" text COLLATE "default",
	"gplus_uid" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"gplus_name" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"gplus_data" text COLLATE "default",
	"token" varchar(255) DEFAULT NULL::character varying COLLATE "default",
	"two_step_code" varchar(255) DEFAULT NULL::character varying COLLATE "default"
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."user_sonata" OWNER TO "postgres";

COMMENT ON COLUMN "public"."user_sonata"."roles" IS '(DC2Type:array)';
COMMENT ON COLUMN "public"."user_sonata"."facebook_data" IS '(DC2Type:json)';
COMMENT ON COLUMN "public"."user_sonata"."twitter_data" IS '(DC2Type:json)';
COMMENT ON COLUMN "public"."user_sonata"."gplus_data" IS '(DC2Type:json)';

-- ----------------------------
--  Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS "public"."question";
CREATE TABLE "public"."question" (
	"id" int4 NOT NULL,
	"id_exam_type" int4,
	"id_knowledge_area" int4,
	"id_proccess_group" int4,
	"title" text NOT NULL COLLATE "default",
	"explanation" text NOT NULL COLLATE "default",
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."question" OWNER TO "postgres";

-- ----------------------------
--  Table structure for exam
-- ----------------------------
DROP TABLE IF EXISTS "public"."exam";
CREATE TABLE "public"."exam" (
	"id" int4 NOT NULL,
	"id_exam_type" int4,
	"id_user" int4,
	"finished" bool NOT NULL,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."exam" OWNER TO "postgres";

-- ----------------------------
--  Table structure for user_limit
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_limit";
CREATE TABLE "public"."user_limit" (
	"id" int4 NOT NULL,
	"id_exam_type" int4,
	"id_user" int4,
	"allowed" int4,
	"used" int4,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."user_limit" OWNER TO "postgres";

-- ----------------------------
--  Table structure for answer
-- ----------------------------
DROP TABLE IF EXISTS "public"."answer";
CREATE TABLE "public"."answer" (
	"id" int4 NOT NULL,
	"id_question" int4,
	"description" text NOT NULL COLLATE "default",
	"correct" bool NOT NULL,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."answer" OWNER TO "postgres";

-- ----------------------------
--  Table structure for exam_question
-- ----------------------------
DROP TABLE IF EXISTS "public"."exam_question";
CREATE TABLE "public"."exam_question" (
	"id" int4 NOT NULL,
	"id_exam" int4,
	"id_question" int4,
	"id_answer" int4,
	"order" int4,
	"solved" bool,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."exam_question" OWNER TO "postgres";

-- ----------------------------
--  Table structure for konwledge_area
-- ----------------------------
DROP TABLE IF EXISTS "public"."konwledge_area";
CREATE TABLE "public"."konwledge_area" (
	"id" int4 NOT NULL,
	"name" varchar(150) NOT NULL COLLATE "default",
	"description" text COLLATE "default",
	"percentage" int4 NOT NULL,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."konwledge_area" OWNER TO "postgres";

-- ----------------------------
--  Table structure for proccess_group
-- ----------------------------
DROP TABLE IF EXISTS "public"."proccess_group";
CREATE TABLE "public"."proccess_group" (
	"id" int4 NOT NULL,
	"name" varchar(150) NOT NULL COLLATE "default",
	"description" text COLLATE "default",
	"percentage" int4 NOT NULL,
	"current" timestamp NOT NULL
)
WITH (OIDS=FALSE);
ALTER TABLE "public"."proccess_group" OWNER TO "postgres";


-- ----------------------------
--  Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."answer_id_seq" RESTART 2;
ALTER SEQUENCE "public"."exam_id_seq" RESTART 2;
ALTER SEQUENCE "public"."exam_question_id_seq" RESTART 2;
ALTER SEQUENCE "public"."exam_type_id_seq" RESTART 2;
ALTER SEQUENCE "public"."group_sonata_id_seq" RESTART 2;
ALTER SEQUENCE "public"."konwledge_area_id_seq" RESTART 2;
ALTER SEQUENCE "public"."notification__message_id_seq" RESTART 2;
ALTER SEQUENCE "public"."proccess_group_id_seq" RESTART 2;
ALTER SEQUENCE "public"."question_id_seq" RESTART 2;
ALTER SEQUENCE "public"."timeline__action_component_id_seq" RESTART 5;
ALTER SEQUENCE "public"."timeline__action_id_seq" RESTART 2;
ALTER SEQUENCE "public"."timeline__component_id_seq" RESTART 3;
ALTER SEQUENCE "public"."timeline__timeline_id_seq" RESTART 3;
ALTER SEQUENCE "public"."user_limit_id_seq" RESTART 2;
ALTER SEQUENCE "public"."user_sonata_id_seq" RESTART 2;
-- ----------------------------
--  Primary key structure for table notification__message
-- ----------------------------
ALTER TABLE "public"."notification__message" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table notification__message
-- ----------------------------
CREATE INDEX  "idx_created_at" ON "public"."notification__message" USING btree(created_at ASC NULLS LAST);
CREATE INDEX  "idx_state" ON "public"."notification__message" USING btree("state" ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table group_sonata
-- ----------------------------
ALTER TABLE "public"."group_sonata" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table group_sonata
-- ----------------------------
CREATE UNIQUE INDEX  "uniq_179a2a9b5e237e06" ON "public"."group_sonata" USING btree("name" COLLATE "default" ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table fos_user_user_group
-- ----------------------------
ALTER TABLE "public"."fos_user_user_group" ADD PRIMARY KEY ("user_id", "group_id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table fos_user_user_group
-- ----------------------------
CREATE INDEX  "idx_b3c77447a76ed395" ON "public"."fos_user_user_group" USING btree(user_id ASC NULLS LAST);
CREATE INDEX  "idx_b3c77447fe54d947" ON "public"."fos_user_user_group" USING btree(group_id ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table exam_type
-- ----------------------------
ALTER TABLE "public"."exam_type" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Primary key structure for table timeline__action_component
-- ----------------------------
ALTER TABLE "public"."timeline__action_component" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table timeline__action_component
-- ----------------------------
CREATE INDEX  "idx_6acd1b169d32f035" ON "public"."timeline__action_component" USING btree(action_id ASC NULLS LAST);
CREATE INDEX  "idx_6acd1b16e2abafff" ON "public"."timeline__action_component" USING btree(component_id ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table timeline__action
-- ----------------------------
ALTER TABLE "public"."timeline__action" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Primary key structure for table timeline__component
-- ----------------------------
ALTER TABLE "public"."timeline__component" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table timeline__component
-- ----------------------------
CREATE UNIQUE INDEX  "uniq_1b2f01cdd1b862b8" ON "public"."timeline__component" USING btree(hash COLLATE "default" ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table timeline__timeline
-- ----------------------------
ALTER TABLE "public"."timeline__timeline" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table timeline__timeline
-- ----------------------------
CREATE INDEX  "idx_ffbc6ad523edc87" ON "public"."timeline__timeline" USING btree(subject_id ASC NULLS LAST);
CREATE INDEX  "idx_ffbc6ad59d32f035" ON "public"."timeline__timeline" USING btree(action_id ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table user_sonata
-- ----------------------------
ALTER TABLE "public"."user_sonata" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table user_sonata
-- ----------------------------
CREATE UNIQUE INDEX  "uniq_a14ee97692fc23a8" ON "public"."user_sonata" USING btree(username_canonical COLLATE "default" ASC NULLS LAST);
CREATE UNIQUE INDEX  "uniq_a14ee976a0d96fbf" ON "public"."user_sonata" USING btree(email_canonical COLLATE "default" ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table question
-- ----------------------------
ALTER TABLE "public"."question" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table question
-- ----------------------------
CREATE INDEX  "idx_b6f7494e810f6dbd" ON "public"."question" USING btree(id_exam_type ASC NULLS LAST);
CREATE INDEX  "idx_b6f7494e85c7ca5a" ON "public"."question" USING btree(id_knowledge_area ASC NULLS LAST);
CREATE INDEX  "idx_b6f7494ecaab93ac" ON "public"."question" USING btree(id_proccess_group ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table exam
-- ----------------------------
ALTER TABLE "public"."exam" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table exam
-- ----------------------------
CREATE INDEX  "idx_38bba6c66b3ca4b" ON "public"."exam" USING btree(id_user ASC NULLS LAST);
CREATE INDEX  "idx_38bba6c6810f6dbd" ON "public"."exam" USING btree(id_exam_type ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table user_limit
-- ----------------------------
ALTER TABLE "public"."user_limit" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table user_limit
-- ----------------------------
CREATE INDEX  "idx_9d5413386b3ca4b" ON "public"."user_limit" USING btree(id_user ASC NULLS LAST);
CREATE INDEX  "idx_9d541338810f6dbd" ON "public"."user_limit" USING btree(id_exam_type ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table answer
-- ----------------------------
ALTER TABLE "public"."answer" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table answer
-- ----------------------------
CREATE INDEX  "idx_dadd4a25e62ca5db" ON "public"."answer" USING btree(id_question ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table exam_question
-- ----------------------------
ALTER TABLE "public"."exam_question" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Indexes structure for table exam_question
-- ----------------------------
CREATE INDEX  "idx_f593067db39bbac4" ON "public"."exam_question" USING btree(id_exam ASC NULLS LAST);
CREATE INDEX  "idx_f593067de62ca5db" ON "public"."exam_question" USING btree(id_question ASC NULLS LAST);
CREATE INDEX  "idx_f593067dfceaffc8" ON "public"."exam_question" USING btree(id_answer ASC NULLS LAST);

-- ----------------------------
--  Primary key structure for table konwledge_area
-- ----------------------------
ALTER TABLE "public"."konwledge_area" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Primary key structure for table proccess_group
-- ----------------------------
ALTER TABLE "public"."proccess_group" ADD PRIMARY KEY ("id") NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table fos_user_user_group
-- ----------------------------
ALTER TABLE "public"."fos_user_user_group" ADD CONSTRAINT "fk_b3c77447a76ed395" FOREIGN KEY ("user_id") REFERENCES "public"."user_sonata" ("id") ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."fos_user_user_group" ADD CONSTRAINT "fk_b3c77447fe54d947" FOREIGN KEY ("group_id") REFERENCES "public"."group_sonata" ("id") ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table timeline__action_component
-- ----------------------------
ALTER TABLE "public"."timeline__action_component" ADD CONSTRAINT "fk_6acd1b169d32f035" FOREIGN KEY ("action_id") REFERENCES "public"."timeline__action" ("id") ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."timeline__action_component" ADD CONSTRAINT "fk_6acd1b16e2abafff" FOREIGN KEY ("component_id") REFERENCES "public"."timeline__component" ("id") ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table timeline__timeline
-- ----------------------------
ALTER TABLE "public"."timeline__timeline" ADD CONSTRAINT "fk_ffbc6ad59d32f035" FOREIGN KEY ("action_id") REFERENCES "public"."timeline__action" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."timeline__timeline" ADD CONSTRAINT "fk_ffbc6ad523edc87" FOREIGN KEY ("subject_id") REFERENCES "public"."timeline__component" ("id") ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table question
-- ----------------------------
ALTER TABLE "public"."question" ADD CONSTRAINT "fk_b6f7494e810f6dbd" FOREIGN KEY ("id_exam_type") REFERENCES "public"."exam_type" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."question" ADD CONSTRAINT "fk_b6f7494e85c7ca5a" FOREIGN KEY ("id_knowledge_area") REFERENCES "public"."konwledge_area" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."question" ADD CONSTRAINT "fk_b6f7494ecaab93ac" FOREIGN KEY ("id_proccess_group") REFERENCES "public"."proccess_group" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table exam
-- ----------------------------
ALTER TABLE "public"."exam" ADD CONSTRAINT "fk_38bba6c6810f6dbd" FOREIGN KEY ("id_exam_type") REFERENCES "public"."exam_type" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."exam" ADD CONSTRAINT "fk_38bba6c66b3ca4b" FOREIGN KEY ("id_user") REFERENCES "public"."user_sonata" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table user_limit
-- ----------------------------
ALTER TABLE "public"."user_limit" ADD CONSTRAINT "fk_9d541338810f6dbd" FOREIGN KEY ("id_exam_type") REFERENCES "public"."exam_type" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."user_limit" ADD CONSTRAINT "fk_9d5413386b3ca4b" FOREIGN KEY ("id_user") REFERENCES "public"."user_sonata" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table answer
-- ----------------------------
ALTER TABLE "public"."answer" ADD CONSTRAINT "fk_dadd4a25e62ca5db" FOREIGN KEY ("id_question") REFERENCES "public"."question" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

-- ----------------------------
--  Foreign keys structure for table exam_question
-- ----------------------------
ALTER TABLE "public"."exam_question" ADD CONSTRAINT "fk_f593067db39bbac4" FOREIGN KEY ("id_exam") REFERENCES "public"."exam_type" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."exam_question" ADD CONSTRAINT "fk_f593067de62ca5db" FOREIGN KEY ("id_question") REFERENCES "public"."question" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE "public"."exam_question" ADD CONSTRAINT "fk_f593067dfceaffc8" FOREIGN KEY ("id_answer") REFERENCES "public"."answer" ("id") ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE;

