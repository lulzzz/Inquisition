# Inquisition
[![Documentation Status](https://readthedocs.org/projects/inquisition-siem/badge/?version=latest)](http://inquisition-siem.readthedocs.io/en/latest/?badge=latest)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/528dcd48a63f4ca0b321814d4577aa52)](https://www.codacy.com/app/magneticstain/Inquisition?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=magneticstain/Inquisition&amp;utm_campaign=Badge_Grade)
[![Coverage Status](https://coveralls.io/repos/github/magneticstain/Inquisition/badge.svg?branch=master)](https://coveralls.io/github/magneticstain/Inquisition?branch=master)
[![Build Status](https://travis-ci.org/magneticstain/Inquisition.svg?branch=master)](https://travis-ci.org/magneticstain/Inquisition)
[![Stories in Ready](https://badge.waffle.io/magneticstain/Inquisition.svg?label=ready&title=Ready)](http://waffle.io/magneticstain/Inquisition)

An advanced and versatile open-source SIEM platform

# Introduction
Inquisition utilizes three pieces of software in order to analyze your environments logs and generate security events
that you **actually** want to know about.

**Anatomize.py** scans and parses your log files and sticks them in an in-memory log store for further analysis.

**Destiny.py** utilizes machine-learning (TensorFlow) in order to analyze the log store and generate new security events.

**Celestial** provides a front-end web GUI and API for managing your Inquisition install, responding to events, and receiving
awareness of the security of your environment.

# Installation
Installation of Inquisition is easy: install the requirements, install the software, and run through setup for your environment.

You can find instructions on how to install Inquisition by visiting the [installation guide](https://github.com/magneticstain/Inquisition/wiki/Installing-Inquisition-Suite) page in the project wiki.

# Usage
After installing the software, we're now ready to start using it. For information on how to use Inquisition, visit the [user guide](https://github.com/magneticstain/Inquisition/wiki/Inquisition-User-Guide).