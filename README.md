# HortiBuddy!

## TOC

* Introduction
* Installation
* Roadmap

## Introduction

HortiBuddy is meant to be a gardener's companion. It can either be a standalone mobile database, or a central self-hosted and multi-input database. The point is to encourage the minimal daily practice of writing down key metrics of a gardening environment, so that historical data can be later analyzed for improvement.

## Installation

HortiBuddy currently requires the following:

* PHP FPM v7.2
* NGINX
* SQLite3

On an `apt` based system, you can run something like:

```
sudo apt-get install -y nginx sqlite3 php7.2-fpm php7.2-sqlite3
```

## Roadmap

The eventual goal is to be able to release this as a deployable app on mobile platforms and via Docker.

Future features include:

* Notifications at user-defined intervals to get data, or perform other garden related tasks.
* Write and read from the calendar to set photoperiod dates, recurring tasks, etc.
* Store data into InfluxDB, so as to be compatible with the future hardware and to allow easy Grafana access.