
print('Preparing data. This might take a while...')

import os
import feather
import pandas as pd
import geopandas

data_folder =  '/Users/Karen/OneDrive/GitHub/ctc21-doric-tiles/data/'



'''
Converting district and postcode shp files from NRS to encoding supported by OpenStreetMaps
https://www.nrscotland.gov.uk/statistics-and-data/geography/our-products/other-national-records-of-scotland-nrs-geographies-datasets
'''

### Convert shp files to encoding supported by OpenStreetMaps, this can take a while
postcodes = geopandas \
            .GeoDataFrame \
            .from_file(data_folder + 'original shp/CivilParish1930.shp') \
            .to_crs(epsg='4326') \
            .to_file(data_folder + 'CivilParish1930_epsg4326.shp')
print('postcode shp files converted')