#! /usr/bin/env node

// disable log to prevent Gun welcome message
const originalLog = console.log;
console.log = () => {};

const Gun = require("gun");

// restore log
console.log = originalLog;

// disable other Gun logs
Gun.log.off = true;

const args = process.argv.slice(2);
const command = args[0] ?? "get";
const key = args[1] ?? "/";
const value = args[2];

const gun = Gun(["https://gun.jo2.ch/gun"]);

const node = gun.get("shared-textarea-" + key);

const content = node.get("content");

if (command === "get") {
  content.once((data) => {
    console.log(data);
    process.exit(0);
  });
}

if (command === "put") {
  content.put(value, (ack) => {
    if (ack.err) {
      console.error("Error:", ack.err);
      process.exit(1);
    } else {
      console.log("Data written");
      process.exit(0);
    }
  });
}
