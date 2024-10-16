#!/usr/bin/env python
import preprocessing

# https://martin-thoma.com/configuration-files-in-python/#python-configuration-file
mysql = {
    "SOURCE_DB":"dbname",
    "SOURCE_HOST_DB":"host",
    "SOURCE_USER":"user",
    "SOURCE_PASS":"password",

    "SINK_DB":"dbname",
    "SINK_HOST_DB":"host",
    "SINK_USER": "user",
    "SINK_PASS": "password",
}
preprocessing_queue = [
    preprocessing.scale_and_center,
    preprocessing.dot_reduction,
    preprocessing.connect_lines,
]
use_anonymous = True