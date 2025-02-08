#!/usr/bin/env python3
import sys
import json
import random

def main():
    # Parse command-line arguments into numbers
    try:
        numbers = [float(arg) for arg in sys.argv[1:]]
    except ValueError:
        print(json.dumps({'error': 'All arguments must be numeric.'}))
        sys.exit(1)

    # Calculate the sum of the numbers
    result = sum(numbers)
    # Output the result as JSON
    print(json.dumps(result))

if __name__ == '__main__':
    main()
